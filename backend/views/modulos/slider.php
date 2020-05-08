<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor de archivos

      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
        <li class="active">Archivos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modal-insertar-slider">Agregar Archivo <i class="fas fa-plus"></i></button>

     <a href="../index.php"> <button class="btn btn-success" data-toggle="modal">Presentación <i class="fas fa-binoculars"></i></button></a>

        <?php

          $slider = ControllerSlider::listarSliderCtr();?> 






 <style>
ul{
padding: 0px;

}
#mi_lista li{
  width: 80%;
color: #fff;
background-color: #052d5f;
border-color: #007bff;
margin: 0 0 3px;
padding: 10px;
list-style: none;
cursor:pointer;
}
#mi_lista li:hover{
  background: #7d9bc0;
}

.btn{
      padding: 6px 6px;
      display: initial;

}
</style>

<div class="container" style="margin-top: 30px;"> 


    <?php if(count($slider)>0):?>

     <div id="mensaje"></div>

<ul id="mi_lista">

      <?php 
      foreach($slider as $img => $value):?>
    
    <li id="miorden_<?php  echo $value["id"]; ?>">
       

           

<?php

if($value['extension']=="otro"){

echo '<ul style="background:#ea2e3a;padding:5px;">';
 echo $value["id"] . " - ";
  echo $value["titulo"];
echo '</ul>';
} else{
  echo $value["id"] . " - ";
  echo substr($value["rutaImg"], 25); 
  echo '<span style="float:right;">';
     echo '<a class="btn btn-success" href="'.substr($value["rutaImg"], 3).'">Ver</a>';
        echo '<a class="btn btn-sm btn-danger btnEliminarSlider" idSlider="'.$value["id"].'" rutaImagen="'.$value["rutaImg"].'">Eliminar</a>';
   
  echo'</span>';   
}

      ?>
  
    
</li>
      <?php endforeach;?>

    <?php else:?>
      <h4 class="alert alert-warning">No hay imagenes!</h4>
    <?php endif; ?>
</ul>
</div>


    </section>
    <!-- /.content -->
  </div>


 

   <!-- Contenido --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
$(document).ready(function () {
    $(function () {
                    $("#mi_lista").sortable({update: function () {
              var ordem_atual = $(this).sortable("serialize");
              $.post("proceso_orden.php", ordem_atual, function (retorno) {
                //Imprimir resultado 
                $("#mensaje").html(retorno);
                //Muestra mensaje
                $("#mensaje").slideDown('slow');
                RetirarMensaje();
              });
            }
                    });
                });
        
// Elimina mensajes despues de un determiando periodo de tiempo 1900 milissegundos
  function RetirarMensaje(){
          setTimeout( function (){
            $("#mensaje").slideUp('slow', function(){});
          }, 1900);
        }
            });
    </script>


