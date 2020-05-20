
 <style type="text/css">
      input[type="file"]{
  margin:0 0 15px;
  padding:10px 1%;

  -webkit-border-radius:3px;
  -moz-border-radius:3px;
  border-radius:3px;
}
.principal{
  width: 80%;
  margin:0 auto;
  padding:0 0 6% 0;
  clear: both;
}
.barra{
  background-color: #f3f3f3;
  border-radius: 5px;
  box-shadow: inset 0px 0px 5px rgba(0,0,0,.2);
  height: 40px;
}
.cancel{
  background: #ed1f3c !important;
}
.barra_azul{
  background-color: #247CC0;
  border-radius: 10px;
  display: block;
  height: 40px;
  line-height: 40px;
  text-align: center;
  width: 0%;
}
.barra_verde{
  background-color:#2EA265!important;
}
.barra_roja{
  background-color:#DE3152!important;
}
#form_subir{
  margin:1.5% 0;
  padding: 2%;
}
#barra_estado span{
  color:#fff;
  font-weight: bold;
  line-height: 40px;
}

    </style>
<div class="modal fade" id="modal-insertar-slider"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
  <h2 style="margin-left: 10px;">Subir archivos</h2>
      </div>   
      <div class="modal-body">
        <div class="principal">
<form action="" id="form_subir">
   <div class="form-group">
 <label for="exampleFormControlSelect1">Seleccionar tipo de archivo :</label>
      <select class="form-control" name="extension" id="cifrado" onchange="mostrarInput();"required>
      <option value="" selected disabled>Seleccionar</option>
      <option id="img" value="img">Imagen</option>
      <option id="video" value="video">Video</option>
      <option id="excel" value="excel">Documento Excel</option>
      <option id="otro" value="otro">Tabla Info Linea</option>
      <option id="otro" value="tabladetalles">Tabla Info Total</option>
    </select>
     </div> 
          <div id="tit"class="form-group row">
            <label class="col-sm-2 col-form-label" style="margin-top: 3px;">Titulo:</label>
            <div class="col-sm-10">
          <input class="form-control" placeholder="Titulo" id="titulo" type="text" name="titulo" required>
            </div>
          </div>
 <div class="form-group row" id="archivovideo">
            <label class="col-sm-2 col-form-label" style="margin-top: 3px;">Video:</label>
     <div class="form-1-2  col-sm-10  conteNuevaImagen" >
  <input type="file" name="archivo" id="videos" required> 
  <video src="" id="videoslider" class="thumbnail" width="300"   alt="" style="display: none" controls>
</video>
</div>
</div>
           <div class="form-group row"id="archivos">
            <label class="col-sm-2 col-form-label" style="margin-top: 3px;">Imagen:</label>
<div class="form-1-2 col-sm-10 conteNuevaImagen" >
  <input type="file" name="archivo" id="imagen" required> 
   <img src="" id="imagenSlider" alt="" class="thumbnail" width="300" style="display: none">
</div>
</div>
  <div class="form-group row"id="archivoexcel">
            <label class="col-sm-2 col-form-label" style="margin-top: 3px;">Url Excel:</label>
<div class="form-1-2 col-sm-8 row conteNuevaImagen" >
  <input class="form-control col-sm-8 "  placeholder="Pegar Url " type="text" name="excels" id="excels" required>
</div>
<button class="btn btn-warning col-sm-2" id="limpiar">Limpiar</button>
  <iframe id="exceliframe" src="" style="width:450px; height:350px;" frameborder="0"></iframe>
</div>
 <div id="tiempo"class="form-group row">
 <label class="col-sm-3 col-form-label" for="exampleFormControlSelect1">Asignar tiempo :</label>
            <div class="col-sm-7">
       <input type="text"  id="Precio" placeholder="Segundos" value="" class="form-control monto" onkeyup="multi();" onkeypress='return validaNumericos(event)' > 
 </div>
 <label class="col-sm-2 col-form-label" for="exampleFormControlSelect1">Segundos</label>
 </div>
<div class="barra">
  <div class="barra_azul" id="barra_estado">
    <span></span>
  </div>
</div>
<div class="acciones" style="margin-top: 30px;margin-left: 310px;">
  <input type="submit" class="btn btn-primary" value="Enviar"></input>
<!--   <input type="button" class="cancel btn btn-danger" id="cancelar" value="Cancelar"></input> -->
  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>
   <label>
      <input  class="form-group" type="hidden" name="Cantidad" id="Cantidad" class="monto" value="1000" onkeyup="multi();">
    </label>
 <input class="form-group" id="Costo" type="hidden" name="tiempo">
<input class="form-group" type="hidden" name="tiempo" id="infos" >
          <input type="hidden" name="tipoOperacion" value="insertarSlider">
</form>
</div>
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
        <div id="tit"class="form-group row">
            <label class="col-sm-2 col-form-label" style="margin-top: 3px;">Titulo:</label>
            <div class="col-sm-10">
          <input class="form-control" placeholder="Titulo" id="titulo" type="text" name="titulo" required>
            </div>
          </div>
      <div class="form-group row">
 <label class="col-sm-3 col-form-label" for="exampleFormControlSelect1">Asignar tiempo :</label>
            <div class="col-sm-7">
       <input type="text"  placeholder="Segundos" name="segundos"  class="form-control monto" onkeypress='return validaNumericos(event)' > 
 </div>
 <label class="col-sm-2 col-form-label" for="exampleFormControlSelect1">Segundos</label>
 </div>
          <input type="hidden" name="tipoOperacion" value="actualizarSlider">
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
document.getElementById('videos').onchange = setFileInfo;


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
    var total = 1000;
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
  var video = document.getElementById('archivovideo');
  var excel = document.getElementById('archivoexcel');
  var otro = document.getElementById('tit');
  var select = document.getElementById('cifrado');
  //ocultar input fecha y numero
  inputDate.style.display = "none";
  archivos.style.display = "none";
  video.style.display = "none";
  excel.style.display = "none";
  otro.style.display = "none";
function mostrarInput(){
  var valorSeleccionado = select.value;
  if(valorSeleccionado == 'img'){
      inputDate.style.display = "block";
       archivos.style.display = "block"; 
        otro.style.display = "block";
  video.style.display = "none";
  excel.style.display = "none";
  }
  if(valorSeleccionado == 'video'){
       archivos.style.display = "none";
       excel.style.display = "none";
       otro.style.display = "block";
      inputDate.style.display = "none";
  video.style.display = "block";
  }
  if(valorSeleccionado=='otro'){
   otro.style.display = "block";
  inputDate.style.display = "block";
 archivos.style.display = "none";
 excel.style.display = "none";
  video.style.display = "none";
  }
    if(valorSeleccionado=='tabladetalles'){
   otro.style.display = "block";
  inputDate.style.display = "block";
 archivos.style.display = "none";
  video.style.display = "none";
 excel.style.display = "none";
  }
 if(valorSeleccionado=='excel'){
   otro.style.display = "block";
  inputDate.style.display = "block";
 archivos.style.display = "none";
  video.style.display = "none";
 excel.style.display = "block";

  }
}
$( function() {
    $("#cifrado").change( function() {
          if ($(this).val() === "video") {
            $("#titulo").prop("disabled", false);
            $("#imagen").prop("disabled", true);      
            $("#videos").prop("disabled", false);
            $("#Precio").prop("required", false);
            $("#excels").prop("required", false);

        }
        if ($(this).val() === "img") {
            $("#infos").prop("disabled", true);
            $("#titulo").prop("disabled", false);
            $("#imagen").prop("disabled", false);        
            $("#videos").prop("disabled", true);
            $("#excels").prop("disabled", true);

            $("#Precio").prop("required", true);
            $("#excel").prop("required", false);

        } else {
            $("#Costo").prop("disabled", false);
        }
        if($(this).val()=="otro"){
            $("#infos").prop("disabled", true);
            $("#imagen").prop("required", false);
            $("#videos").prop("required", false);
            $("#excels").prop("required", false);
            $("#titulo").prop("disabled", false);
        }
        else{
          $("#Costo").prop("disabled",false);
        }
         if($(this).val()=="tabladetalles"){
            $("#infos").prop("disabled", true);
            $("#imagen").prop("required", false);
            $("#videos").prop("required", false);
            $("#excels").prop("required", false);
            $("#titulo").prop("disabled", false);
        }
        else{
          $("#Costo").prop("disabled",false);
        }
        if($(this).val()=="excel"){
            $("#infos").prop("disabled", true);
            $("#imagen").prop("required", false);
            $("#videos").prop("required", false);
            $("#excels").prop("disabled", false);

            $("#excels").prop("required", true);
            $("#titulo").prop("disabled", false);
        }
        else{
          $("#Costo").prop("disabled",false);
        }
    });
});

  if($("#excels").val()==''){
    $("#exceliframe").css("display", "none")
            
}
      $("#excels").keyup(function () {
            var value = $(this).val();
         if(value==''){
             $("#exceliframe").css("display", "none")
           
}else{
  $('#exceliframe').attr('src',value);
  $("#exceliframe").css("display", "block") 
}
             
           } )      
         $('#limpiar').click(function() {
    $('#excels').val('');
     $('#exceliframe').attr('src','');
             $("#exceliframe").css("display", "none")

  });
</script>

