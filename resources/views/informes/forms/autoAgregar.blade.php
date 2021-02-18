<!-- autocompletes para analisis-->
<script type="text/javascript">
  $('#c1').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c1').val(ui.item.id);
      $("#n1").html(ui.item.value);
      $("#ub1").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c1').val(ui.item.id);
     }
});

</script>


<script type="text/javascript">
  
  $('#c1').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c2").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c2').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
    $('#c2').val(ui.item.id);
      $("#n2").html(ui.item.value);
       $("#ub2").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c2').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c2').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c3").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c3').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c3').val(ui.item.id);
      $("#n3").html(ui.item.value);
       $("#ub3").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c3').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c3').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c4").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c4').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c4').val(ui.item.id);
      $("#n4").html(ui.item.value);
       $("#ub4").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c4').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c4').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c5").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c5').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
       $('#c5').val(ui.item.id);
      $("#n5").html(ui.item.value);
       $("#ub5").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c5').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c5').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c6").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c6').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c6').val(ui.item.id);
      $("#n6").html(ui.item.value);
       $("#ub6").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c6').val(ui.item.id);
     }
  })
</script>

<script type="text/javascript">
  
  $('#c6').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c7").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c7').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c7').val(ui.item.id);
      $("#n7").html(ui.item.value);
     $("#ub7").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c7').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c7').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c8").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c8').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
       $('#c8').val(ui.item.id);
      $("#n8").html(ui.item.value);
       $("#ub8").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c8').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c8').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c9").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c9').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
       $('#c9').val(ui.item.id);
      $("#n9").html(ui.item.value);
       $("#ub9").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c9').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c9').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c10").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c10').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c10').val(ui.item.id);
      $("#n10").html(ui.item.value);
       $("#ub10").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c10').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c10').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c11").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c11').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c11').val(ui.item.id);
      $("#n11").html(ui.item.value);
       $("#ub11").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c11').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c11').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c12").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c12').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c12').val(ui.item.id);
      $("#n12").html(ui.item.value);
       $("#ub12").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c12').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c12').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c13").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c13').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
       $('#c13').val(ui.item.id);
      $("#n13").html(ui.item.value);
       $("#ub13").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c13').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c13').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c14").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c14').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c14').val(ui.item.id);
      $("#n14").html(ui.item.value);
       $("#ub14").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c14').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c14').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c15").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c15').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c15').val(ui.item.id);
      $("#n15").html(ui.item.value);
       $("#ub15").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c15').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c15').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c16").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c16').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c16').val(ui.item.id);
      $("#n16").html(ui.item.value);
       $("#ub16").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c16').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c16').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c17").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c17').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c17').val(ui.item.id);
      $("#n17").html(ui.item.value);
       $("#ub17").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c17').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c17').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c18").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c18').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c18').val(ui.item.id);
      $("#n18").html(ui.item.value);
       $("#ub18").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c18').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c18').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c19").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c19').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c19').val(ui.item.id);
      $("#n19").html(ui.item.value);
       $("#ub19").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c19').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c19').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c20").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c20').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c20').val(ui.item.id);
      $("#n20").html(ui.item.value);
       $("#ub20").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c20').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c20').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c21").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c21').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c21').val(ui.item.id);
      $("#n21").html(ui.item.value);
       $("#ub21").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c21').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c21').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c22").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c22').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c22').val(ui.item.id);
      $("#n22").html(ui.item.value);
       $("#ub22").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c22').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c22').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c23").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c23').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c23').val(ui.item.id);
      $("#n23").html(ui.item.value);
       $("#ub23").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c23').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c23').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c24").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c24').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c24').val(ui.item.id);
      $("#n24").html(ui.item.value);
       $("#ub24").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c24').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c24').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#c25").focus();  
    }
});
</script>

<script type="text/javascript">
  $('#c25').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#c25').val(ui.item.id);
      $("#n25").html(ui.item.value);
       $("#ub25").val(ui.item.otro);
     },
     change: function(event,ui){
          $('#c25').val(ui.item.id);
     }
  });
</script>

<script type="text/javascript">
  
  $('#c25').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $("#btt").focus();  
    }
});
</script>
