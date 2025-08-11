<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Contracts\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;

class UserController extends Controller
{

    protected UserServiceInterface $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = $this->service->getAllUser();
        return (UserResource::collection($users))->response()->setStatusCode(200);
    }

    public function show(int $id)
    {
        $user = $this->service->getUserId($id);

        return (new UserResource($user))->response()->setStatusCode(200);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $user = $this->service->saveUser($data);

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $user = $this->service->getUserId($id);

        $data = $request->validated();

        $this->service->updateUser($user, $data);

        return (new UserResource($user))->response()->setStatusCode(200);
    }

    public function destroy(int $id)
    {
        $user = $this->service->getUserId($id);

        $this->service->destroyUser($user);

        return response()->noContent();
    }
}
