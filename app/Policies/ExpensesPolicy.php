<?php

namespace App\Policies;

use App\Models\Expenses;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpensesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function checkExpense(User $user, Expenses $expenses){
        return $user->id === $expenses->user_id;
    }
}
