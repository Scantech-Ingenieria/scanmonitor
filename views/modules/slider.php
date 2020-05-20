<?php
$images = ControllerProductos::ctrMostrarBanner();
sleep(3);
 if(count($images)>0);
// include('views/modules/tabla.php');
 echo "<div id='carouselExampleControls' class='carousel slide'  data-ride='carousel'>";
 echo " <div class='carousel-inner' role='listbox'>";
 $con_slide=0;
foreach($images as $img => $value){
   $active = "";
      if($con_slide==0){
 $active = "active";
   }
  echo "<div class='carousel-item $active' data-interval=".$value['tiempo'].">";
if($value['extension']=="video"){
  echo '<div class="delimitador">
<video  class="img-responsive center-block" style="margin-bottom: 100px;width:100%;height:100%;" muted="muted">';
  echo '<source src="backend/'.substr($value['rutaImg'],3).'" type="video/mp4">';
  echo "</video>
</div>";
} else if($value['extension']=="img"){
 echo '<img src="backend/'.substr($value['rutaImg'],3).'" style="width:100%;height:700px;">';
} else if($value['extension']=="tabladetalles"){
 echo "<div id='tabladetalles' style='height: 700px;width: 100%;'></div>";
} else if($value['extension']=="excel"){
 echo '<div  style="height: 700px;width: 100%;"> <iframe  src="'.$value["excel"].'" style="width:100%;height:100%;" frameborder="0"></iframe></div>';
}else if($value['extension']=="otro"){
echo "<div id='tabla'>";
echo "</div>"; 
}  
else if($value['extension']=="primero"){

} 
   echo "</div>";
   $con_slide++;    
}  
echo "</div>";
echo "</div>";
?>
        <?php  $pesaje = ControllerProductos::listarPesajeCtr();
      foreach ($pesaje as $key => $value) {
 echo'<input type="hidden" name="" id="contratista" value="'.$value["contratista"].'">
  <input type="hidden" name="" id="fecha_inicial" value="'.$value["fecha"].'">
  <input type="hidden" name="" id="inputBrazo4" value="'.$value["brazo_cuatro"].'">
  <input type="hidden" name="" id="inputBrazo3" value="'.$value["brazo_tres"].'">
  <input type="hidden" name="" id="inputBrazo2" value="'.$value["brazo_dos"].'">
  <input type="hidden" name="" id="inputBrazo1" value="'.$value["brazo_uno"].'">
  <input type="hidden" name="" id="isFirst" value="'.$value["first"].'">
  <input type="hidden" name="" id="CD_PONTO" value="'.$value["cd_ponto"].'">
';
      }
      
?> 
<script >
    $(function() { 
        cron(); 
        function cron() {
          var contratista= document.getElementById("contratista").value;
          var fecha_inicial= document.getElementById("fecha_inicial").value;
          var inputBrazo4= document.getElementById("inputBrazo4").value;
          var inputBrazo3= document.getElementById("inputBrazo3").value;
          var inputBrazo2= document.getElementById("inputBrazo2").value;
          var inputBrazo1= document.getElementById("inputBrazo1").value;
          var isFirst= document.getElementById("isFirst").value;
          var CD_PONTO= document.getElementById("CD_PONTO").value;
            $.ajax({
                method: "POST",
                url: "views/modules/tabla.php", // Podrías separar las funciones de PHP en un fichero a parte
                data: {
                    action: 1,
                    contratista:contratista,
                    fecha_inicial:fecha_inicial,
                    inputBrazo4:inputBrazo4,
                    inputBrazo3:inputBrazo3,
                    inputBrazo2:inputBrazo2,
                    inputBrazo1:inputBrazo1,
                    isFirst:isFirst,
                    CD_PONTO:CD_PONTO
                }
            }).done(function(msg) {
                 $('#tabla').html(msg);
            });
        }
        setInterval(function() {
            cron();
        }, 5000); // Lanzará la petición cada 5 segundos
    });
</script>
<script >
    $(function() { // Ojo! uso jQuery, recuerda añadirla al html
        crondetalles(); // Lanzo cron la primera vez
        function crondetalles() {
            $.ajax({
                method: "POST",
                url: "views/modules/tablatotal.php", // Podrías separar las funciones de PHP en un fichero a parte        
            }).done(function(msg) {
                 $('#tabladetalles').html(msg);
            });
        }
        setInterval(function() {
            crondetalles();
        }, 5000); // Lanzará la petición cada 5 segundos
    });
</script>
<script type="text/javascript">
$(function() {
  $('#carouselExampleControls').on('slid.bs.carousel', function (e) {
   let elemento = $('#carouselExampleControls .carousel-item.active video').first();
   if (elemento.prop("tagName") == "VIDEO") {
     elemento.get(0).play();
   }
});
});
</script>












