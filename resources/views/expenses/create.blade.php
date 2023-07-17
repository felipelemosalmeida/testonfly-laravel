@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Despesas</div>
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{route('expenses.store')}}" class="form" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Descrição:</label>
                                <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{ $expense->description ?? old('description') }}">
                            </div>
                            <div class="form-group">
                                <label>Data:</label>
                                <input type="date" name="date" class="form-control" value="{{ $expense->date ?? old('date') }}">
                            </div>
                            <div class="form-group">
                                <label>Valor:</label>
                                <input type="text" name="price" class="form-control" placeholder="R$" value="{{ $expense->price ?? old('price') }}" step="any">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



