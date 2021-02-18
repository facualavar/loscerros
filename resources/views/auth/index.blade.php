@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-11"><h3>Usuarios</h3></div>
                    <div class="col-md-2"><button class="btn1 btn-primary" data-toggle="modal" data-target="#myModalUser" title="Agregar Usuario"><i class="fa fa-plus"> </i><i class="fa fa-user"></i></button></div>
                    @include('auth.forms.modalUser')
                </div>
                <div class="card-body table-responsive">
                    <table id="data_table_users" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 124px;">Perfil</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 224px;">Nombre</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 199px;">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 156px;">Cargo</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 112px;">Estado</th>
                                <th  class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 112px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $k=>$user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td><img src="{{env('URL_BASE_UPLOADS').$user->imagen}}" alt="user image" class="rounded-circle img-40 align-top mr-15"></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->rol}}</td>
                                <td>{{$user->nombreestado}}</td>
                                <td>
                                    @if(Auth::user()->Roles_idRoles==1)
                                        @can('USUARIOS - editar') <a href="{{ route('perfil',['id'=>$user->id]) }}" title="Editar Perfil" class="feed-card"><i class="ik ik-edit bg-blue feed-icon"></i></a> @endcan
                                    @elseif(Auth::user()->id == $user->id)
                                        @can('USUARIOS - editar') <a href="{{ route('perfil',['id'=>$user->id]) }}" title="Editar Perfil" class="feed-card"><i class="ik ik-edit bg-blue feed-icon"></i></a> @endcan
                                    @endif
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
