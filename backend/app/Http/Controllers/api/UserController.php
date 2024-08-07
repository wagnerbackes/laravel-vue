<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $UserRepositoryInterface)
    {
        $this->userRepositoryInterface = $UserRepositoryInterface;
    }

    public function index()
    {
        $users = $this->userRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(UserResource::collection($users), '', 200);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        return new UserResource($user);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ];

        DB::beginTransaction();
        try {
            $course = $this->userRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new UserResource($course), 'Usuário criado com sucesso', 201);
        } catch (\Exception $ex) {
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function show($id)
    {
        $users = $this->userRepositoryInterface->getById($id);
        return ApiResponseHelper::sendResponse(new UserResource($users), '', 200);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ];

        DB::beginTransaction();
        try {
            $course = $this->userRepositoryInterface->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Usuário atualizado com sucesso', 200);
        } catch (\Exception $ex) {
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function destroy($id)
    {
        $this->userRepositoryInterface->delete($id);
        return ApiResponseHelper::sendResponse(null, 'Usuário removido com sucesso');
    }
}
