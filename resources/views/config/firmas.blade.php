@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Configuración de Firmas</h3></div>
                <div class="card-body table-responsive">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                               <div class="col-md-6">
                                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}"> {{-- para el ajax del dropzone --}}
                                    <label for="">Cargar firma</label>
                                    <div class="dropzone" id="dropzone">
                                            <div class="table table-striped files" id="previews">

                                                <div id="template">
                                                    <!-- This is used as the file preview template -->

                                                    <span class="preview"><img data-dz-thumbnail {{-- style="height: 107px;"  --}}/></span>
                                                    <div class="dz-preview dz-file-preview col-md-10">
                                                        <div class="dz-details">
                                                        </div>
                                                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                                      </div>

                                                </div>
                                            </div>
                                    </div>

                                     <div id="actions" class="row">
                                        <div class="col-md-12">
                                            <span class="btn1 btn-success fileinput-button center-block" >
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <i class="fa fa-camera" aria-hidden="true"><a href="" title="Agregar Fotos">.</a></i>
                                            </span>
                                        </div>
                                    </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
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
                    url: "{{asset('firmaFotos')}}",
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
            document.getElementById('actions').style.display = 'none';
        });
</script>
@endsection
