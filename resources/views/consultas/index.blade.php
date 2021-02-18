@extends('layouts.api')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="card">
                @if($alert)
                <div class="alert alert-{{ $alert['class'] }} alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $alert['msg'] }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card-header"><h3>Consultas de Analisís</h3></div>

                <div class="card-body">
                    <form action="{{ route('consultaInformes') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="dni">DNI:</label>
                            <input type="text" class="form-control" id="dni" name="dni" placeholder="39234501">
                        </div>
                        <div class="form-group">
                            <label for="codigo">Codigo:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>

                        <button type="submit" class="btn btn-primary">Consultar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection