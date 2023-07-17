<?php

namespace App\Services;

use App\Notifications\ExpenseCreate;
use App\Repositories\Contracts\ExpensesRepositoryInterface;

class ExpensesService
{
    private $repository;

    public function __construct(ExpensesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    private function getUserIdExpenses()
    {
        return auth()->check() ? auth()->user()->id : null;
    }

    private function getUserAuthenticated(){
        return auth()->check() ? auth()->user() : null;
    }

    public function create(array $data){
        $data['user_id'] = $this->getUserIdExpenses();
        $expense = $this->repository->create($data);

        $config_user_email_check = config('mail.username');

        if(!is_null($config_user_email_check) && $this->getUserAuthenticated()){
            $this->getUserAuthenticated()->notify(new ExpenseCreate($expense));
        }

        return $expense;
    }

    public function show($id){
        return $this->repository->show($id);
    }

    public function update(array $data, $id){
        return $this->repository->update($data, $id);
    }

    public function destroy($id){
        return $this->repository->destroy($id);
    }

    public function getAll(){
        return $this->repository->getAll($this->getUserIdExpenses());
    }
}
