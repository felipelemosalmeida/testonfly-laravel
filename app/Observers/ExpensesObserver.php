<?php

namespace App\Observers;

use App\Models\Expenses;
use Illuminate\Support\Facades\Auth;

class ExpensesObserver
{
    /*public function creating(Expenses $expenses)
    {
        $expenses->user_id = auth()->check() ? auth()->user()->id : null;
    }*/
}
