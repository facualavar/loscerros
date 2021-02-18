<div class="row" style="padding: 1.75rem;">
@if(isset(getAntibiograma($id)->antibiogramaS))
  @if(getAntibiograma($id)->antibiogramaS!='' || getAntibiograma($id)->antibiogramaSI!='' || getAntibiograma($id)->antibiogramaR!='')
<h4>ANTIBIOGRAMA (Antibióticos tildados)</h4>
  <?php /* $array = explode("•", $d->antibiogramaS);
        $cadena=  implode (  $array ); */
        $array = explode("<br>", getAntibiograma($id)->antibiogramaS);

       /*  $array1 = explode("•", $d->antibiogramaSI);
        $cadena1=  implode (  $array1 ); */
        $array1 = explode("<br>", getAntibiograma($id)->antibiogramaSI);

        /* $array2 = explode("•", $d->antibiogramaR);
        $cadena2=  implode (  $array2 ); */
        $array2 = explode("<br>", getAntibiograma($id)->antibiogramaR);
         ?>


<div class="col-md-4">
  <h4>Sensible</h4>

  <?php for ($i = 0; $i <count($array) ; $i++) {?>
      @if($array[$i]!='')
      <input type="checkbox" name="antiS[]" value="<?php echo $array[$i]?>" checked><?php echo $array[$i]?> <br>
      @endif
  <?php  } ?>
</div>

<div class="col-md-4">
  <h4>Sensibilidad Intermedia</h4>

 <?php for ($i = 0; $i <count($array1) ; $i++) {?>
      @if($array1[$i]!='')
      <input type="checkbox" name="antiSI[]" value="<?php echo $array1[$i]?>" checked><?php echo $array1[$i]?> <br>
      @endif
 <?php  } ?>
</div>

<div class="col-md-4">
  <h4>Resistente</h4>
 <?php for ($i = 0; $i <count($array2) ; $i++) {?>
      @if($array2[$i]!='')
      <input type="checkbox" name="antiR[]" value="<?php echo $array2[$i]?>" checked><?php echo $array2[$i]?> <br>
      @endif
 <?php  } ?>
</div>

@endif
@endif
</div>
