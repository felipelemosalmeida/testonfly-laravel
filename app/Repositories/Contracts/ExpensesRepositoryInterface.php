<?php

namespace App\Repositories\Contracts;

interface ExpensesRepositoryInterface
{
    public function create(array $data);
    public function show($id);
    public function update(array $data, $id);
    public function destroy($id);
    public function getAll(int $user_id);
}
