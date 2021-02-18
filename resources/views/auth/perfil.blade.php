@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="profile-pic mb-20">
                    <img src="{{($user->imagen)? env('URL_BASE_UPLOADS').$user->imagen : env('URL_BASE_UPLOADS').'user.png'}}" width="150" class="rounded-circle" alt="user">
                    <h4 class="mt-20 mb-0"> {{ $user->name }} </h4>
                </div>
                <div class="col-md-12 badge badge-pill badge-dark">Cambiar imagen</div>
            </div>
            <div class="p-4 border-top mt-15">
                <div class="row text-center">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}"> {{-- para el ajax del dropzone --}}

                    <div class="dropzone col-md-12" id="dropzone">
                            <div class="table table-striped files" id="previews">
                                <div id="template">
                                    <!-- This is used as the file preview template -->
                                    <span class="preview"><img data-dz-thumbnail/></span>
                                    <div class="dz-preview dz-file-preview col-md-10">
                                        <div class="dz-details">
                                        </div>
                                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                        </div>
                                </div>
                            </div>
                    </div>

                    <div id="actions" class="row">
                        <div class="col-md-4">
                            <span class="btn1 btn-success fileinput-button center-block" >
                                <i class="glyphicon glyphicon-plus"></i>
                                <i class="fa fa-camera" aria-hidden="true"><a href="" title="Agregar Fotos">.</a></i>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3>Datos del Usuario</h3></div>
            <div class="card-body">
                {!!Form::model($user,['route'=>['usuario.update',$user],'method'=>'PUT','class'=>'forms-sample'])!!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!!Form::label('Estado:')!!}
                                {!!Form::select('estado', ['1' => 'Activo','2' => 'Inactivo'],$user->estado, ['class'=>'form-control','placeholder' => 'Estado'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!!Form::label('Tipo de usuario:')!!}
                                {!!Form::select('Roles_idRoles', ['1' => 'Administrador','2' => 'Bioquimico', '3' => 'Tecnico/a'],$user->Roles_idRoles, ['class'=>'form-control','placeholder' => 'Tipo'])!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!!Form::label('Nombre:')!!}
                                {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del usuario'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!!Form::label('Correo:')!!}
                                {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese el email del usuario'])!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                                {!!Form::label('Contraseña:')!!}
                                {!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingrese la contraseña'])!!}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!!Form::label('Nueva Contraseña:')!!}
                                {!!Form::password('repassword',['class'=>'form-control','placeholder'=>'Ingrese la contraseña nuevamente'])!!}
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="imagen" name="imagen"> {{-- aqui el nombre de la imagen del perfil en caso que se cargue una --}}
                    {!!Form::submit('Actualizar',['class'=>'btn btn-primary mr-2'])!!}

                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>


@endsection

@section('scriptsextras')

    <script type="text/javascript">
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(
                   "#dropzone", {
                    url: "{{asset('fotos')}}",
                    method:"post",
                    maxFileSize: 100, //esta en MB
                    acceptedFiles: 'image/*, .jpeg, .jpg, .png, .JPEG, .JPG, .PNG, .psd',
                    parallelUploads: 20,
                    dictDefaultMessage: "",
                    previewTemplate: previewTemplate,
                    autoQueue: true,
                    previewsContainer: "#previews", // define el contenedor para la miniatura
                    clickable: ".fileinput-button", // defiene el elemento que dispara la carga de archivos.

                });
        myDropzone.on("complete", function (file) {
            if (file.status == "success")
            {
              swal("El archivo " + file.name + " se cargo correctamente");
            }
        });

        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}");
        });

        myDropzone.on("success",function(data){
            var aux=JSON.parse(data.xhr.responseText);
            document.getElementById('imagen').value=aux.imagen;
            document.getElementById('actions').style.display = 'none';
        });
    </script>

@endsection
