<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\HolidayTypeResource;
use App\Repositories\HolidayTypeRepository;
use App\Traits\ApiTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HolidayTypeController extends Controller
{
    use ApiTrait;

    /**
     * @var HolidayTypeRepository
     */
    private $repository;

    /**
     * SizeController constructor.
     * @param HolidayTypeRepository $repository
     */
    public function __construct(HolidayTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return HolidayTypeResource::collection($this->repository->get());
    }

    public function create()
    {
        return response(__('holiday.not_ allowed'));
    }

    public function store(Request $request)
    {

        $this->repository->create($request->all());
        return $this->createApiSuccessMessage();
    }

    public function show($id)
    {
        return response(__('holiday.not_ allowed'));
    }

    public function edit($id)
    {
        return new HolidayTypeResource($this->repository->find($id));
    }

    public function update(Request $request, $id)
    {
        /**
         * Extra logic, because customer didn't want to do normal
         */
        if(in_array($id, [4, 5])) {
            $this->repository->update([
                'url' => $request->url,
                'explanation' => $request->explanation
            ], $id);
        } else {
            $this->repository->update($request->all(), $id);
        }
        return $this->createApiSuccessMessage();
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return $this->createApiSuccessMessage();
        } catch (QueryException $e) {
            return $this->createApiErrorMessage(__('holiday.unknown'));
        }
    }
}
