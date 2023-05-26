<?php

namespace App\Http\Controllers\Api\Admin;

use App\Events\BookingCreated;
use App\Http\Requests\Booking\CreateRequest;
use App\Http\Resources\BookingResource;
use App\Http\Services\BookingService;
use App\Http\Services\PdfService;
use App\Models\Provider;
use App\Models\Texts;
use App\Repositories\BookingRepository;
use App\Traits\ApiTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    use ApiTrait;

    /**
     * @var BookingRepository
     */
    private $repository;
    /**
     * @var BookingService
     */
    private $bookingService;

    /**
     * @var PdfService
     */
    private $pdfService;
    private $booking;

    /**
     * BookingController constructor.
     * @param BookingRepository $repository
     * @param BookingService $bookingService
     * @param PdfService $pdfService
     */
    public function __construct(BookingRepository $repository, BookingService $bookingService, PdfService $pdfService)
    {
        $this->repository = $repository;
        $this->bookingService = $bookingService;
        $this->pdfService = $pdfService;
    }

    public function index()
    {
        return BookingResource::collection($this->repository->get());
    }

    public function create()
    {
        return response('Not allowed');
    }

    public function store(CreateRequest $request)
    {
        $data = $request->all();
        $checkResult = $this->bookingService->checkCreateData($data);
        if(false === $checkResult) {
            return $this->createApiErrorMessage('Choose holiday type and travel agency!');
        }
        $booking = $this->repository->create($data);
        $this->booking = $booking;
        $this->bookingService->saveTravelAgencies($booking->id, explode(',', $data['agencies'][0]));
        event(new BookingCreated($booking));
        if((int)$booking->provider_id === Provider::REISBUREAU && $booking->location_id < 3) {
            $text = Texts::where('provider_id', '=', Provider::REISBUREAU)->first();
            $text->first_paragraph = $this->pasteVars($text->first_paragraph);
            $text->second_paragraph = $this->pasteVars($text->second_paragraph);
            $text->third_paragraph = $this->pasteVars($text->third_paragraph);
            $text->epilogue = $this->pasteVars($text->epilogue);
            $pdf = $this->pdfService
                ->build('pdf/policy', ['booking' => $booking, 'text' => $text])
                ->download($booking->last_name . '_booking.pdf');
            return $pdf;
        }
        return $this->createApiSuccessMessage();
    }

    public function show($id)
    {
        return response('Not allowed');
    }

    public function edit($id)
    {
        return new BookingResource($this->repository->find($id));
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request->all(), $id);
        return $this->createApiSuccessMessage();
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return $this->createApiSuccessMessage();
        } catch (QueryException $e) {
            return $this->createApiErrorMessage('Unknown holiday type');
        }
    }

    /**
     * TODO replace to service (?)
     * @param $text
     * @return mixed
     */
    private function pasteVars($text)
    {
        $_agency = '';
        foreach ($this->booking->agencies as $agency) {
            $name = $agency->name . ', ';
            $_agency .= $name;
        }
        $_agency = substr($_agency, 0, strlen($_agency) - 2);
        if(!$this->booking->holiday) {
            $text = str_replace('%type_reis%', 'Doorverkoper', $text);
        } else {
            $text = str_replace('%type_reis%', $this->booking->holiday->name, $text);
        }
        $text = str_replace('%location%', $this->booking->location->name, $text);
        $text = str_replace('%agency%', $_agency, $text);
        return $text;
    }
}
