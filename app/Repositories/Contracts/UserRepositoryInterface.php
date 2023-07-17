<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function get($email);
    public function create(array $data);
    public function createToken(User $user);
    public function getToken(User $user);

}
