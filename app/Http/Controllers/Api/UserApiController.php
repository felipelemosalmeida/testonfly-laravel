<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\StoreUpdateUser;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    //
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function register(StoreUpdateUser $request){
        return new UserResource($this->userService->create($request->all()));
    }

    public function login(AuthLoginRequest $request){
        $user = new UserResource($this->userService->validateLogin($request->all()));
        return response()->json($user, 200);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return response()->json([], 204);
    }

    public function me(Request $request){
        return new UserResource($request->user());
    }
}
