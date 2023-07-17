<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function create(array $data){
        $user = $this->entity->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user['token'] = $this->createToken($user);

        return $user;
    }

    public function createToken(User $user){
        $uuid = Str::uuid();
        return $user->createToken($uuid)->plainTextToken;
    }

    public function getToken(User $user){
        if($user->tokens->first()) {
            $user->tokens()->delete();
        }

        return $this->createToken($user);
    }

    public function get($email){
        return $this->entity::where('email', $email)->first();
    }

}
