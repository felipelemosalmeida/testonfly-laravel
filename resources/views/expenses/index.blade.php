@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de Despesas</div>

                    <div class="card-body">
                        <a href="{{ route('expenses.create') }}" class="btn btn-dark">ADD DESPESA</a>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <table class="table table-condensed mt-2">
                                <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Preço</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>
                                            {{ $expense->description }}
                                        </td>
                                        <td>
                                            {{ $expense->date }}
                                        </td>
                                        <td>
                                            R$ {{ number_format($expense->price, 2, ',', '.') }}
                                        </td>
                                        <td style="width=10px;">
                                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ route('expenses.show', $expense->id) }}" class="btn btn-warning">VER</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
