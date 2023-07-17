<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
       $this->repository = $repository;
    }

    public function create(array $data){
        return $this->repository->create($data);
    }

    public function validateLogin(array $data){
        $user = $this->repository->get($data['email']);

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => [trans('messages.invalid_credentials')],
            ]);
        }

        $user['token'] = $this->repository->getToken($user);

        return $user;
    }
}
