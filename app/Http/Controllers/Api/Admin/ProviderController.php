<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\ProviderResource;
use App\Repositories\TravelAgencyRepository;
use App\Traits\ApiTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
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
        return ProviderResource::collection($this->repository->get());
    }

    public function create()
    {
        return response('Not allowed');
    }

    public function store(Request $request)
    {
        $this->repository->create($request->all());
        return $this->createApiSuccessMessage();
    }

    public function show($id)
    {
        return response(__('agency.not_allowed'));
    }

    public function edit($id)
    {
        return new ProviderResource($this->repository->find($id));
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
            return $this->createApiErrorMessage(__('agency.unknown'));
        }
    }
}
