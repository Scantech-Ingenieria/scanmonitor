<div class="content-wrapper">
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
     <a href="../inde.php"> <button class="btn btn-success" data-toggle="modal">Presentación <i class="fas fa-binoculars"></i></button></a>
        <?php
          $slider = ControllerSlider::listarSliderCtr();?> 
 <style>
ul{
padding: 0px;
}
#mi_lista li{
  width: 90%;
color: #fff;
background-color: #0a448d;
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
.contador{
  width:5%;
  font-size: 16.8px;
  text-align: center;
    background: #0a448d;
  
}
.contador p{
  padding: 9.7px;
  color:white;
  margin:0px;
}
.lista{
  width: 92%;
}
.contador,.lista{
  display: inline-block;
}
</style>
<div class="container listatotal" style="margin-top: 30px;"> 
    <?php if(count($slider)>0):?>
     <div id="mensaje"></div>     

      <?php
         $contador=1;   
      echo'<div  class="contador">';
foreach ($slider as $key => $value) {
 echo '<p color="white;">#'.$contador.'</p>';
 $contador++;
}
      echo'</div>';

  ?>  
<ul id="mi_lista" class="lista">
      <?php 
      foreach($slider as $img => $value):?>
    <li id="miorden_<?php  echo $value["id"]; ?>">
<?php

if($value['extension']=="otro"){

 echo $value["id"] . " - ";
  echo $value["titulo"];

echo '   <span style="float:right;">
 <a class="btn btn-sm btn-info btnEditarSlider" idslider="'.$value["id"].'"data-toggle="modal" data-target="#modal-editar-slider">
                    <i class="far fa-edit"></i>Editar</a> <a class="btn btn-sm btn-danger btnEliminarSlider" idSlider="'.$value["id"].'" rutaImagen="'.$value["rutaImg"].'">Eliminar</a></span>';
} else if ($value['extension']=="img") {
  echo $value["id"] . " - ";
  echo $value["titulo"]; 
  echo '<span style="float:right;">
<a type="button" class="btn btn-success" data-toggle="modal" data-target="#'.$value["id"].'" style="margin-right:5px;">
 Ver
</a>
 <a class="btn btn-sm btn-info btnEditarSlider" idslider="'.$value["id"].'"data-toggle="modal" data-target="#modal-editar-slider">
                    <i class="far fa-edit"></i>Editar</a>
        <a class="btn btn-sm btn-danger btnEliminarSlider" idSlider="'.$value["id"].'" rutaImagen="'.$value["rutaImg"].'">Eliminar</a>


<!-- Modal -->
<div class="modal fade" id="'.$value["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:black;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          
        </button>
        <h3><strong>Titulo Archivo: </strong>'.$value["titulo"].'</h3>
      </div>
      <div class="modal-body">
       <div class="col-sm-12">

<a href="'.substr($value["rutaImg"], 3).'"><img  style="width:100%;"  src="'.substr($value["rutaImg"], 3).'"></a>
           </div>
      
           </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>
  </span>'; 
}else if ($value['extension']=="video"){
  echo $value["id"] . " - ";
  echo $value["titulo"]; 
  echo '<span style="float:right;">
<a type="button" class="btn btn-success" data-toggle="modal" data-target="#'.$value["id"].'" style="margin-right:5px;">
 Ver
</a>
 <a class="btn btn-sm btn-info btnEditarSlider" idslider="'.$value["id"].'"data-toggle="modal" data-target="#modal-editar-slider">
                    <i class="far fa-edit"></i>Editar</a>
        <a class="btn btn-sm btn-danger btnEliminarSlider" idSlider="'.$value["id"].'" rutaImagen="'.$value["rutaImg"].'">Eliminar</a>
<!-- Modal -->
<div class="modal fade" id="'.$value["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:black;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button><h3><strong>Titulo Archivo: </strong>'.$value["titulo"].'</h3>
      </div>
      <div class="modal-body">
       
       <div class="col-sm-12">
<video style="width:100%;" src="'.substr($value["rutaImg"], 3).'" controls>
  Tu navegador no implementa el elemento <code>video</code>.
</video>
       </div>

           </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
   
      </div>
    </div>
  </div>
</div>
  </span>';   
}else if ($value['extension']=="excel"){

  echo $value["id"] . " - ";
  echo $value["titulo"]; 
  echo '<span style="float:right;">
<a type="button" class="btn btn-success" data-toggle="modal" data-target="#'.$value["id"].'" style="margin-right:5px;">
 Ver
</a>
 <a class="btn btn-sm btn-info btnEditarSlider" idslider="'.$value["id"].'"data-toggle="modal" data-target="#modal-editar-slider">
                    <i class="far fa-edit"></i>Editar</a>
        <a class="btn btn-sm btn-danger btnEliminarSlider" idSlider="'.$value["id"].'" rutaImagen="'.$value["rutaImg"].'">Eliminar</a>
<!-- Modal -->
<div class="modal fade" id="'.$value["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:black;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
             <h3><strong>Titulo Archivo: </strong>'.$value["titulo"].'</h3>
      </div>
      <div class="modal-body">
       <div class="col-sm-12">
   
      <iframe  src="'.$value["excel"].'" style="width:100%;height:400px;" frameborder="0"></iframe>
           </div>
           </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
   
      </div>
    </div>
  </div>
</div>
  </span>'; 


}
else if ($value['extension']=="tabladetalles"){

 echo $value["id"] . " - ";
  echo $value["titulo"];

echo '   <span style="float:right;">
 <a class="btn btn-sm btn-info btnEditarSlider" idslider="'.$value["id"].'"data-toggle="modal" data-target="#modal-editar-slider">
                    <i class="far fa-edit"></i>Editar</a> <a class="btn btn-sm btn-danger btnEliminarSlider" idSlider="'.$value["id"].'" rutaImagen="'.$value["rutaImg"].'">Eliminar</a></span>';
}
    

      ?>   
</li>

      <?php endforeach;?>
    <?php else:?>
      <h4 class="alert alert-danger">No hay archivos!</h4>
    <?php endif; ?>
</ul>
</div>
    </section>
  </div>
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


