<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateExpenses;
use App\Http\Resources\ExpensesResource;
use App\Services\ExpensesService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class ExpensesApiController extends Controller
{
    //
    protected $expensesService;

    public function __construct(ExpensesService $expensesService)
    {
        $this->expensesService = $expensesService;
    }

    public function store(StoreUpdateExpenses $request){
        $expense = new ExpensesResource($this->expensesService->create($request->all()));
        return $expense;
    }

    public function update(StoreUpdateExpenses $request, $id){
        $expense = $this->expensesService->show($id);
        $this->authorize('checkExpense', $expense);

        $expense = $this->expensesService->update($request->all(), $id);
        return response()->json(['success'], 200);
    }

    public function show($id){
        $expense = $this->expensesService->show($id);

        $this->authorize('checkExpense', $expense);

        return response()->json(new ExpensesResource($expense), 200);
    }

    public function destroy($id){
        $expense = $this->expensesService->show($id);

        $this->authorize('checkExpense', $expense);

        $this->expensesService->destroy($id);

        return response()->json(['success'], 200);
    }

    public function getAll(){
        $expenses =  ExpensesResource::collection($this->expensesService->getAll());
        return response()->json($expenses, 200);
    }
}
