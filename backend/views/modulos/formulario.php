<?php 
    function getBalanzas(){
  $DB_SERVER = "localhost";
  $DB_USERNAME = "sa";
  $DB_PASSWORD = "sa";
  $DB_DATABASE = "CL3500";
  // Array asociativo con la información de la conexion 
  $connectionInfo = array("UID"=>$DB_USERNAME, "PWD"=>$DB_PASSWORD, "Database"=>$DB_DATABASE);
  // Nos conectamos mediante la autenticación de SQL Server
  $conn = sqlsrv_connect($DB_SERVER, $connectionInfo);
      // Ultimo lote ingresado en tabla de pesaje
      $sql = "SELECT CD_PONTO, DS_PONTO
          FROM LK_PONTO_CONTROLE
          ORDER BY CD_PONTO";
      $stmt = sqlsrv_query( $conn, $sql );
      if( $stmt === false) {
          die( print_r( sqlsrv_errors(), true) );
      }
      echo "<select class='form-control' name='CD_PONTO' id='CD_PONTO'>";    
      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
          echo "<option value=" . $row['CD_PONTO'] . ">" 
              . $row['DS_PONTO']
              . '</option>';
      }
      echo "</select>";
      sqlsrv_free_stmt( $stmt);
      sqlsrv_close($conn);
    }
     function salida(){
  $DB_SERVER = "localhost";
  $DB_USERNAME = "sa";
  $DB_PASSWORD = "sa";
  $DB_DATABASE = "CL3500";
  // Array asociativo con la información de la conexion 
  $connectionInfo = array("UID"=>$DB_USERNAME, "PWD"=>$DB_PASSWORD, "Database"=>$DB_DATABASE);
  // Nos conectamos mediante la autenticación de SQL Server
  $conn = sqlsrv_connect($DB_SERVER, $connectionInfo);
$sql = "SELECT NR_SAIDA FROM LK_PESAGEM where NR_SAIDA is not null group by NR_SAIDA order by NR_SAIDA asc" ;
 $salida = sqlsrv_query( $conn, $sql );
  if( $salida === false) {
          die( print_r( sqlsrv_errors(), true) );
      }
   echo " <select class='form-control' name='salida' id='salida'>"; 
    echo "<option style='color:black;' value='' selected disabled>Seleccione opción</option>";    
      while( $row = sqlsrv_fetch_array( $salida, SQLSRV_FETCH_ASSOC) ) {

          echo "<option value=" . $row['NR_SAIDA'] . ">" 
              . $row['NR_SAIDA']
              . '</option>';
      }
      echo "</select>";
     }
?>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> 
<div class="content-wrapper" style="background: url('views/dist/img/fondo3.jpg')no-repeat fixed center; width: 100%;color: white; ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <br>
      <h1 style="padding-left:10%;font-size: 30px;">
Formulario 
      </h1>
      <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
        <li class="active">Archivos</li>
      </ol>

      <!-- Button trigger modal -->
<button style="margin-left: 70%;"type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
Último Registro
</button>

<!-- Modal -->
<div style="color :black;"class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Último Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-group">
            <label for="recipient-name" class="col-form-label">Balanza:</label>
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Fecha:</label>

          </div>
<div class="form-group">
            <label for="recipient-name" class="col-form-label">Nro de Brazos:</label>

          </div>
<div class="form-group">
            <label for="recipient-name" class="col-form-label">Contratista:</label>        
  
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
<style type="text/css">
  #datetime-inicial::placeholder {
 color:white;
}
</style>
<form method="POST" action="" id="form_pesaje" >
 <div class="container" style="width: 70%;padding-right: 20%;margin-top: 20px;">
  <div class="grid-block" >
  <div class="col-md-12" style="margin-bottom: 40px;">
        <div id="select-info-wrapper">
          <label>Seleccione balanza</label>
        <?php getBalanzas(); ?>  
        </div>
</div>
         <div class="form-group">
          <div class="row">
            <div class="col-md-7" >
    <div id="datetime-title">
          <label>Fecha y hora de producción para comienzo de conteo:</label>
        </div>
        </div>
      <div class="col-md-5" >
        <div id="calendar">
          <input  type="text"class="form-control"name="fecha_inicial"  placeholder="Seleccione fecha y hora"   id="datetime-inicial" style="background-color: #525252;
    color: white;" required>
        </div>
        </div>
         </div> 
        </div>  
        <br>
        <h3 style="text-align: center;">Ingrese dotación por línea</h3>
        <br>
<div  class="row">
  <div class="col-md-3"> <h4>Nro brazos :</h4></div>
  <div class="col-md-7"> <?php salida(); ?>  </div>
</div>
    <div class="form-group">
 <div id="dinami"></div>
</div>       
  <div class="form-group">
            <label>Seleccione contratista:</label>
            <select class="form-control" name="inputContratista" id="contratista" >
              <option value="Profisur">
                Profisur
              </option>
              <option value="G y N">
                G y N
              </option>
            </select>
          </div>                
    <input type="hidden" name="isFirst" id="isFirst" value="true">
          <input type="hidden" name="tipoOperacion" value="insertarPesaje">
    <div class="form-group" style="padding-top: 30px;"> 
 <button type="button" class="btn btn-warning btn-lg" id="btn-1" style="padding-left:40%;padding-right: 40%;">Confirmar Datos</button>
 <button type="button" class="btn btn-warning btn-lg" id="btn-3" style="padding-left:40%;padding-right: 40%;display: none">Cargando... <img src="1.gif" style="opacity: 1;width: 25%; 
    left: 0px;
    top: 0px;"></button>
        <button  style='display: none;padding-left:40%;padding-right: 40%; 'type="submit" id='nuevo_formulario' class="btn btn-success btn-lg">Cargar Datos</button>
    </div>  
</div> 
    </div>
</form>
    </section>
  </div>
<div id="tabla"></div>

<script type="text/javascript">
$("#salida").change(function() { 
$('.row00').remove();
  var sel = $(this).val();
var sel2 = 1
for (var i=0; i<sel; i++) {
    console.log('intento ' + i);
 $('#dinami').append('<div style="margin-top:20px;" class="row row00" id="row00'+i+'">  <div class="col-md-2" style="padding: 0px;text-align: center;"><h4>Línea -></h4></div><div class="col-md-6"><input type="number" class="form-control" id="inputBrazo" name="inputBrazo'+i+'" value="0" placeholder="línea 1"></div><div class="col-md-3"><select class="form-control" name="linea[]" id="linea" style="color: black;width: 100%;"><option>'+sel2+'</option></select></div><div class="col-md-1" >  <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove00" >-</button></div></div>');
sel2++ 
}
})
$(document).on('click', '.btn_remove00', function(){
        var button_id = $(this).attr("id"); 
        $('#row00'+button_id+'').remove();
    });
</script>
   <script>
$('#btn-1').click(function(){
  //una vez que tenemos la tabla recorremos esta misma recorriendo cada TR y por cada uno de estos se ejecuta el siguiente codigo
    //por cada fila o TR que encuentra rescatamos 3 datos, el ID de cada fila, la Descripción 
var form= $('#myForm');
   $.ajax({
            method: 'POST',
            url: 'views/modulos/historial.php',
            data:form.serialize() //Aquí tienes que enviar la información que necesita si no tiene nada puedes dejarlo así {}
 }).done(function(msg) {
                console.log(msg);
                 $('#tabla').html(msg);
            });
 $('#btn-1').hide(10);
  $('#nuevo_formulario').show(10);
})
    </script>
 <script>
      $(document).ready(function(){
      flatpickr("#datetime-inicial", {
        enableTime: true,
    dateFormat: "Y-m-d H:i",
 locale: {
        firstDayOfWeek: 1,
        weekdays: {
          shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
          longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
        }, 
        months: {
          shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
          longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        },
      },
      });
      });
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>