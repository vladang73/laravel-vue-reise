<?php

namespace App\Http\Controllers\Api\Admin;

use App\Events\DefaultSchedulingCreated;
use App\Events\DefaultSchedulingUpdated;
use App\Http\Resources\SchedulingResource;
use App\Http\Services\SchedulingService;
use App\Repositories\CountSchedulingRepository;
use App\Repositories\SchedulingRepository;
use App\Repositories\UsersRepository;
use App\Traits\ApiTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchedulingController extends Controller
{
    use ApiTrait;

    /**
     * @var UsersRepository
     */
    private $repository;
    private $schedulingService;
    private $countRepository;

    /**
     * SchedulingController constructor.
     * @param SchedulingRepository $repository
     * @param SchedulingService $schedulingService
     */
    public function __construct(SchedulingRepository $repository, SchedulingService $schedulingService, CountSchedulingRepository $countSchedulingRepository)
    {
        $this->repository = $repository;
        $this->schedulingService = $schedulingService;
        $this->countRepository = $countSchedulingRepository;
    }

    public function index(Request $request)
    {
        $year = $request->get('year');
        $week = $request->get('week');
        if($year && $week) {
            $this->schedulingService->setWeek($year, $week);
        }
        $start = $this->schedulingService->getStartWeekDay();
        $end = $this->schedulingService->getEndWeekDay();
        return SchedulingResource::collection(
            $this->repository
                ->where('start_date', '>=', $start)
                ->where('end_date', '<=', $end)
                ->get()
        );
    }

    public function create()
    {
        return response('Not allowed');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if($request->input('is_default', false)) {
                $count = $this->countRepository->create([]);
            }
            $schedule = $this->repository->create($data);
            if($request->input('is_default', false)) {
                event(new DefaultSchedulingCreated($schedule, $count));
            }
            return $this->createApiSuccessMessage();
        } catch (QueryException $e) {
            dd($e->getMessage());
            return $this->createApiErrorMessage(__('users.wrong_input'));
        }
    }

    public function show($id)
    {
        return response(__('users.not_allowed'));
    }

    public function edit($id)
    {
        return new SchedulingResource($this->repository->find($id));
    }

    public function update(Request $request, $id)
    {
        try {
            if($request->input('is_default', false)) {
                event(new DefaultSchedulingUpdated($request));
            }else{
                $this->repository->update($request->all(), $id);
            }
            return $this->createApiSuccessMessage();
        } catch (QueryException $e) {
            return $this->createApiErrorMessage(__('users.unknown'));
        }
    }

    public function destroy($id)
    {
        if ($id > 1 /*&& Auth::user()->id === 1*/) {
            try {
                $scheduling = $this->repository->find($id);
                if($scheduling->count_scheduling_id > 0){
                    $schedulings = $this->repository->where('count_scheduling_id', '=', $scheduling->count_scheduling_id)->get();
                    foreach ($schedulings as $scheduling){
                        $scheduling->delete();
                    }
                } else {
                    $this->repository->delete($id);
                }
                return $this->createApiSuccessMessage();
            } catch (QueryException $e) {
                return $this->createApiErrorMessage(__('users.unknown'));
            }
        } else {
            return $this->createApiErrorMessage(__('users.not_allowed'));
        }
    }
}
