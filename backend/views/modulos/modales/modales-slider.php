<div class="modal fade" id="modal-insertar-slider"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insertar Nuevo Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-nuevo-slider">
     
  <div class="form-group">
 <label for="exampleFormControlSelect1">Seleccionar tipo de archivo :</label>


      <select name="extension" id="cifrado" onchange="mostrarInput();"required>
          <option value="" selected disabled>Seleccionar</option>
            <option id="img" value="img">Imagen</option>
      <option id="video" value="video">Video</option>
      <option id="otro" value="otro">Otro</option>


    </select>


     </div>
 <div id="tiempo"class="form-group">
 <label for="exampleFormControlSelect1">Asignar tiempo :</label>
       <input type="text"  id="Precio" value="" class="monto" onkeyup="multi();" onkeypress='return validaNumericos(event)' style="width: 100px;"> Segundos
     </div>

   <label>
      <input type="hidden" name="Cantidad" id="Cantidad" class="monto" value="1000" onkeyup="multi();">
    </label>
      
 <input id="Costo" type="hidden" name="tiempo">


<input type="hidden" name="tiempo" id="infos" >


 <div id="tit" class="form-group">
 <label for="exampleFormControlSelect1">Titulo :</label>
<input id="titulo" type="titulo" name="titulo" required>
     </div>

     <div class="form-group row" id="archivos">
            <label class="col-sm-2 col-form-label">Archivo</label>
            <div class="col-sm-10 conteNuevaImagen">
              <input type="file" class="form-control"  id="imagen" name="imagenSlider" required>
              <img src="" id="imagenSlider" alt="" class="thumbnail" width="200" style="display: none">
            </div>
          </div>



          <input type="hidden" name="tipoOperacion" value="insertarSlider">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- EDITAR SLIDER -->
<div class="modal fade" id="modal-editar-slider"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formu-editar-slider">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Imagen</label>
            <div class="col-sm-10 conteEditarImagen">
              <input type="file" class="form-control"  id="imagenEditar" name="imagenSlider">
              <br>
              <img src="" id="imagenSlider" alt="" class="thumbnail" width="200">

            </div>
          </div>


          <input type="hidden" name="tipoOperacion" value="actualizarSlider">
          <input type="hidden" name="rutaActual">
          <input type="hidden" name="id_slider">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
  var myVideos = [];

window.URL = window.URL || window.webkitURL;

document.getElementById('imagen').onchange = setFileInfo;

function setFileInfo() {
  var files = this.files;
  myVideos.push(files[0]);
  var video = document.createElement('video');
  video.preload = 'metadata';

  video.onloadedmetadata = function() {
    window.URL.revokeObjectURL(video.src);
    var duration = video.duration;
    myVideos[myVideos.length - 1].duration = duration;
    updateInfos();
  }

  video.src = URL.createObjectURL(files[0]);;
}


function updateInfos() {
  var infos = document.getElementById('infos');

  infos.value= "";
  cambio="";
  for (var i = 0; i < myVideos.length; i++) {
    infos.value += 1000*Math.round(myVideos[i].duration) + '\n';

  }
}


function multi(){
    var total = 1;
    var change= false; //
    $(".monto").each(function(){
        if (!isNaN(parseFloat($(this).val()))) {
            change= true;
            total *= parseFloat($(this).val());
        }
    });
    // Si se modifico el valor , retornamos la multiplicación
    // caso contrario 0
    total = (change)? total:0;
    document.getElementById('Costo').value = total;
}

function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}




  //seleccionando elementos
  var inputDate = document.getElementById('tiempo');
  var archivos = document.getElementById('archivos');
  var otro = document.getElementById('tit');


  var select = document.getElementById('cifrado');
  
  //ocultar input fecha y numero
  inputDate.style.display = "none";
  archivos.style.display = "none";
  otro.style.display = "none";



  
function mostrarInput(){
  var valorSeleccionado = select.value;
  if(valorSeleccionado == 'img'){
      //ocultar input numero en caso de estar mostrandolo
      //mostrar input fecha
      inputDate.style.display = "block";
       archivos.style.display = "block"; 
        otro.style.display = "none";
  }


  if(valorSeleccionado == 'video'){
      //ocultar input numero en caso de estar mostrandolo
      //mostrar input fecha
       archivos.style.display = "block";
       otro.style.display = "none";
      inputDate.style.display = "none";

  }
  if(valorSeleccionado=='otro'){
       otro.style.display = "block";
  inputDate.style.display = "block";

 archivos.style.display = "none";
  }

}

$( function() {
    $("#cifrado").change( function() {

          if ($(this).val() === "video") {
            $("#titulo").prop("disabled", true);

        }
        if ($(this).val() === "img") {
            $("#infos").prop("disabled", true);
            $("#titulo").prop("disabled", true);

        } else {
            $("#Costo").prop("disabled", false);
      

        }
        if($(this).val()=="otro"){
$("#infos").prop("disabled", true);
$("#imagen").prop("required", false);
            $("#titulo").prop("disabled", false);


        }
        else{
          $("#Costo").prop("disabled",false);

        }
    });
});








</script>