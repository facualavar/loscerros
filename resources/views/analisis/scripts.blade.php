 <script>
    var nextinput = 1;
    function AgregarCampos(tipo) {

        if(tipo=='compuesto'){
             campo ='<tr>'+
               '<td><input type="text" name="codigo[]" class="form-control" value="'+$("#cod").val()+'"></td>'+
               '<td><input type="hidden" name="nombre[]" class="form-control"><textarea type="text" name="nombreFormal[]" id="contentMiniA'+nextinput+'"><div id="removeMini'+nextinput+'">Hacer Click</div></textarea></td>'+
               '<td><textarea name="referencia[]" rows="4" style="width:100%" id="contentA'+nextinput+'" class="form-control"><div id="remove'+nextinput+'">Hacer Click</div></textarea></td>'+
               '<td><input type="text" name="unidades[]" class="form-control"></td>'+
               '</tr>';
        }else{
            campo ='<tr>'+
               '<td><input type="text" name="codigo[]" class="form-control" value="'+$("#cod").val()+'"></td>'+
               '<td><input type="hidden" name="nombre[]" class="form-control"><textarea type="text" name="nombreFormal[]" id="contentMiniA'+nextinput+'" class="form-control"><div id="removeMini'+nextinput+'">Hacer Click</div></textarea></td>'+
               '<td><textarea name="referencia[]" rows="4" style="width:100%" id="contentA'+nextinput+'" class="form-control"><div id="remove'+nextinput+'">Hacer Click</div></textarea></td>'+
               '<td><input type="text" name="unidades[]" class="form-control"></td>'+
               '</tr>';
        }
                
        $("#contenido").append(campo);

        $('textarea#contentA'+nextinput).froalaEditor({
            heightMin: 50,
            language: 'es',
            zIndex: 8000,
            placeholderText: '',
            toolbarSticky: true,     
            fontFamilySelection: true,
            fontSizeSelection: true,     
            initOnClick: true,
            enter: $.FroalaEditor.ENTER_BR,
            toolbarButtons: ['bold', 'italic', 'fontSize', '|',
            'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent'/*, 
            'insertImage'*/, '|', 'html'],               
            //aviaryKey: 'b0c1e5af4b074d4e85b9f82ee32be2b2',
            htmlUntouched : true  
        }).on('froalaEditor.click', function (e, editor) {     
                var i=nextinput - 1;                   
                $('#remove'+i).remove();           
        });

        $('textarea#contentMiniA'+nextinput).froalaEditor({
            heightMin: 50,
            language: 'es',
            zIndex: 8000,
            initOnClick: true,
            placeholderText: '',
            toolbarSticky: true,     
            fontFamilySelection: true,
            fontSizeSelection: true,     
            enter: $.FroalaEditor.ENTER_BR,
            toolbarButtons: ['paragraphFormat', '|', 'bold', 'fontSize', '|', 'html'],    
            // Establece la URL de carga de fotos.
            imageUploadURL: '{!!URL::to('froalaImage') !!}',           
           // aviaryKey: 'b0c1e5af4b074d4e85b9f82ee32be2b2',
            htmlUntouched : true  
        }).on('froalaEditor.click', function (e, editor) {        
                var i=nextinput - 1;                   
                $('#removeMini'+i).remove();           
        });
        
        nextinput++;
    
    }
</script>

 {{-- <script>
        $( function() {
            $( "#opciones" ).sortable({
            revert: true
            });

            $( "tr, td" ).disableSelection();
        } );
    </script> --}}