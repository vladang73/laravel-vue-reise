<?php

namespace App\Http\Controllers\Api\Admin;

use App\Events\AgencyDeleted;
use App\Http\Resources\TravelAgencyResource;
use App\Models\Agency\Document;
use App\Repositories\TravelAgencyRepository;
use App\Traits\ApiTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TravelAgencyController extends Controller
{
    use ApiTrait;

    /**
     * @var TravelAgencyRepository
     */
    private $repository;

    /**
     * SizeController constructor.
     * @param TravelAgencyRepository $repository
     */
    public function __construct(TravelAgencyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return TravelAgencyResource::collection($this->repository->get());
    }

    public function create()
    {
        return response('Not allowed');
    }

    public function store(Request $request)
    {
        $agency = $this->repository->create($request->all());
        foreach ($request->documents as $document) {
            Document::create([
                'agency_id' => $agency->id,
                'name' => $document['name'],
                'url' => $document['url']
            ]);
        }
        return $this->createApiSuccessMessage();
    }

    public function show($id)
    {
        return response(__('agency.not_allowed'));
    }

    public function edit($id)
    {
        return new TravelAgencyResource($this->repository->find($id));
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $agency = $this->repository->find($id);
        foreach ($agency->documents as $document) {
            $document->delete();
        }
        foreach ($request->documents as $document) {
            if(filter_var($document['url'], FILTER_VALIDATE_URL)) {
                Document::create([
                    'agency_id' => $agency->id,
                    'name' => $document['name'],
                    'url' => $document['url']
                ]);
            }
        }
        return $this->createApiSuccessMessage();
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            event(new AgencyDeleted($id));
            return $this->createApiSuccessMessage();
        } catch (QueryException $e) {
            return $this->createApiErrorMessage(__('agency.unknown'));
        }
    }
}
