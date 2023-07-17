@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Despesas</div>

                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <ul>
                                    <li>
                                        <strong>Descrição: </strong> {{ $expense->description }}
                                    </li>
                                    <li>
                                        <strong>Data: </strong> {{ $expense->date }}
                                    </li>
                                    <li>
                                        <strong>Preço: </strong> R$ {{ number_format($expense->price, 2, ',', '.') }}
                                    </li>
                                </ul>

                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
