<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateExpenses;
use App\Http\Resources\ExpensesResource;
use App\Services\ExpensesService;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    //
    protected $expensesService;

    public function __construct(ExpensesService $expensesService)
    {
        $this->expensesService = $expensesService;
    }

    public function index(){
        $expenses =  ExpensesResource::collection($this->expensesService->getAll());
        return view('expenses.index', ['expenses' => $expenses]);
    }

    public function create(){
        return view('expenses.create');
    }

    public function store(StoreUpdateExpenses $request){
        new ExpensesResource($this->expensesService->create($request->all()));
        return redirect()->route('expenses.index');
    }

    public function edit($id){
        $expense = $this->expensesService->show($id);
        $this->authorize('checkExpense', $expense);

        return view('expenses.edit', ['expense' =>  new ExpensesResource($expense)]);
    }

    public function update(StoreUpdateExpenses $request, $id){
        $expense = $this->expensesService->show($id);
        $this->authorize('checkExpense', $expense);

        $this->expensesService->update($request->except('_token'),$id);
        return redirect()->route('expenses.index');
    }

    public function show($id){
        $expense = $this->expensesService->show($id);

        $this->authorize('checkExpense', $expense);

        return view('expenses.show', ['expense' => new ExpensesResource($expense)]);
    }

    public function destroy($id){
        $expense = $this->expensesService->show($id);

        $this->authorize('checkExpense', $expense);

        $this->expensesService->destroy($id);

        return redirect()->route('expenses.index');
    }
}
