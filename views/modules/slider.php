

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>






<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>





<script type="text/javascript">



$( document ).ready(function() {
  $('#carouselExampleControls').on('slid.bs.carousel', function (e) {
   let elemento = $('#carouselExampleControls .carousel-item.active video').first();

   if (elemento.prop("tagName") == "VIDEO") {
     elemento.get(0).play();

   }
});




});

</script>


<script >
    $(function() { // Ojo! uso jQuery, recuerda añadirla al html
        cron(); // Lanzo cron la primera vez
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
                console.log(msg);
                 $('#tabla').html(msg);
            });
        }
        setInterval(function() {
            cron();
        }, 5000); // Lanzará la petición cada 5 segundos
    });
</script>

<?php


echo "<div id='carouselExampleControls' class='carousel slide' data-pause='none' data-ride='carousel'>";



$images = ControllerProductos::ctrMostrarBanner();

 if(count($images)>0);
// include('views/modules/tabla.php');
 echo " <div class='carousel-inner' role='listbox'>";



 $con_slide=0;
foreach($images as $img => $value){
   $active = "";
     
      if($con_slide==0){
 $active = "active";
      }


  echo "<div class='carousel-item $active' data-interval=".$value['tiempo'].">";

if($value['extension']=="video"){

        echo '<video  class="img-responsive center-block" style="margin-bottom: 100px;width:100%;height:100%;" muted="muted">';
        echo '<source src="backend/'.substr($value['rutaImg'],3).'" type="video/mp4">';
    echo  "</video>";
   
} else if($value['extension']=="img"){

 echo '<img src="backend/'.substr($value['rutaImg'],3).'" style="width:100%;">';

}else{
echo "<div id='tabla'>";


        // Llama función para mostrar información de brazos, además crea box.
        // getInfo($_SESSION["current"], $_SESSION["cantidadBrazos"], $_SESSION["fecha_inicial"]);

echo "</div>";
?>

<?php 
}  

    echo "</div>";

   $con_slide++;    
}
   
echo "</div>";




echo "</div>";


?>
  
  <input type="hidden" name="" id="contratista" value="<?php echo $_POST['inputContratista'];?>">
  <input type="hidden" name="" id="fecha_inicial" value="<?php echo $_POST['fecha_inicial'];?>">
  <input type="hidden" name="" id="inputBrazo4" value="<?php echo $_POST['inputBrazo4'];?>">
  <input type="hidden" name="" id="inputBrazo3" value="<?php echo $_POST['inputBrazo3'];?>">
  <input type="hidden" name="" id="inputBrazo2" value="<?php echo $_POST['inputBrazo2'];?>">
  <input type="hidden" name="" id="inputBrazo1" value="<?php echo $_POST['inputBrazo1'];?>">
  <input type="hidden" name="" id="isFirst" value="<?php echo $_POST['isFirst'];?>">
  <input type="hidden" name="" id="CD_PONTO" value="<?php echo $_POST['CD_PONTO'];?>">







<!-- 
<div class="container">
<div id="carouselExampleControls" class="carousel slide" data-pause="none" data-ride="carousel">


    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active" data-interval="2000">
            <img class="d-block img-fluid" src="//placehold.it/1200x500/aaa?text=(2000ms)" alt="First slide">
        </div>
        <div class="carousel-item" data-interval="400">
            <img class="d-block img-fluid" src="//placehold.it/1200x500/222?text=(400ms)" alt="Second slide">
        </div>
        <div class="carousel-item" data-interval="2000">
            <img class="d-block img-fluid" src="//placehold.it/1200x500/aaa?text=(2000ms)" alt="Third slide" >
        </div>
        <div class="carousel-item" data-interval="400">
            <img class="d-block img-fluid" src="//placehold.it/1200x500/222?text=(400ms)" alt="Second slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</div>
 -->











