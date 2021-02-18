@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Roles</h3></div>
                <div class="card-body table-responsive">
                    <table id="data_table_roles" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Rol</th>
                                <th  class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $k=>$rol)
                            <tr>
                                <td>{{$rol->id}}</td>
                                <td>{{$rol->name}}</td>
                                <td>
                                    @can('USUARIOS - ver permisos') <a href="{{ route('permisos',['id'=>$rol->id]) }}" title="Ver Permisos" class="feed-card"><i class="ik ik-eye bg-blue feed-icon"></i></a> @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptsextras')
    @include('auth.scripts')
@endsection
