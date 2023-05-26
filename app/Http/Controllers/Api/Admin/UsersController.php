<?php

namespace App\Http\Controllers\Api\Admin;

use App\Events\UserCreated;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UsersRepository;
use App\Traits\ApiTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    use ApiTrait;

    /**
     * @var UsersRepository
     */
    private $repository;

    /**
     * SizeController constructor.
     * @param UsersRepository $repository
     */
    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return UserResource::collection($this->repository->where('email', '<>', 'admin@site.com')->get());
    }

    public function create()
    {
        return response('Not allowed');
    }

    public function store(Request $request)
    {
        try {
            $user = $this->repository->create($request->all());
            event(new UserCreated($user));
            return $this->createApiSuccessMessage();
        } catch (QueryException $e) {
            return $this->createApiErrorMessage(__('users.wrong_input'));
        }
    }

    public function show($id)
    {
        return response(__('users.not_allowed'));
    }

    public function edit($id)
    {
        return new UserResource($this->repository->find($id));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->repository->update($request->all(), $id);
            return $this->createApiSuccessMessage();
        } catch(QueryException $e) {
            return $this->createApiErrorMessage(__('users.unknown'));
        }
    }

    public function destroy(Request $request, $id)
    {
        if($id > 1 /*&& \Auth::user()->id === 1*/) {
            try {
                $this->repository->delete($id);
                return $this->createApiSuccessMessage();
            } catch (QueryException $e) {
                return $this->createApiErrorMessage(__('users.unknown'));
            }
        }  else {
            return $this->createApiErrorMessage(__('users.not_allowed'));
        }
    }
}
