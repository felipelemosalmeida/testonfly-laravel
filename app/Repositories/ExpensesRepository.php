<?php

namespace App\Repositories;

use App\Models\Expenses;
use App\Repositories\Contracts\ExpensesRepositoryInterface;

class ExpensesRepository implements ExpensesRepositoryInterface
{
    protected $entity;

    public function __construct(Expenses $expenses)
    {
        $this->entity = $expenses;
    }

    public function create(array $data){
        return $this->entity->create([
            'description' => $data['description'],
            'date' => $data['date'],
            'price' => (double)str_replace(",", ".", str_replace(".", "", $data['price'])),
            'user_id' => $data['user_id']
        ]);
    }

    public function show($id){
        return $this->entity->where([
            ['id', $id]
        ])->first();
    }

    public function update(array $data, $id){
        return $this->entity->where('id', $id)->update([
            'description' => $data['description'],
            'date' => $data['date'],
            'price' => (double)str_replace(",", ".", str_replace(".", "", $data['price']))
        ]);
    }

    public function destroy($id)
    {
        $this->entity->where('id', $id)->delete();
    }

    public function getAll(int $user_id){
        return $this->entity->where('user_id', $user_id)->get();
    }
}
