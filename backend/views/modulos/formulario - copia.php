


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
?>

 


    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> 

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
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
<style type="text/css">
  
  #datetime-inicial::placeholder {
 color:white;
}
</style>
<form method="POST" action="../inde.php" >



 <div class="container" style="width: 60%;padding-right: 20%;margin-top: 20px;">
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
          <input  type="text"class="form-control"name="fecha_inicial" id="fecha_inicial" placeholder="Seleccione fecha y hora"   id="datetime-inicial" style="background-color: #525252;
    color: white;" required>
        </div>

        </div>

         </div> 
        </div>  


        <br>

        <h3 style="text-align: center;">Ingrese dotación por línea</h3>

        <br>













    <div class="form-group"> <!-- Full Name -->
      <div class="row">  

<div class="col-md-2" style="padding: 0px;text-align: center;margin-top: 30px;">
        <h4 >Línea -></h4>
      </div>
<div class="col-md-6">
  <h4 style="text-align: center">Dotación</h4>
        <input type="number" class="form-control" id="inputBrazo" name="inputBrazo[]" value="0" placeholder="línea 1">
      </div>
      <div class="col-md-3">
        <h4 style="text-align: center">Brazo</h4>
        <select name="linea[]" id="linea"class="form-control" style="color: black;width: 100%;">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>

        </select>
      </div>

<div class="col-md-1">
         <button style="margin-top: 38px;" type="button" name="add15" id="add15" class="btn btn-success" >+</button>   </div>
  </div>
 <div id="dinami"></div>
  
</div>    

<!--   <div class="form-group">
      <div class="row">      
<div class="col-md-2" style="padding: 0px;text-align: center;">
        <h4>Línea 2 -></h4>
      </div>
<div class="col-md-10">

        <input type="number" class="form-control" name="inputBrazo3" value="0" placeholder="línea 2">
      </div>



    </div>
</div>                    
                            
  <div class="form-group"> 
      <div class="row">      
<div class="col-md-2" style="padding: 0px;text-align: center;">
        <h4>Línea 3 -></h4>
      </div>
<div class="col-md-10">

        <input type="number" class="form-control" name="inputBrazo2" value="0" placeholder="línea 3">
      </div>



    </div>
</div>    
   <div class="form-group"> 
      <div class="row">      
<div class="col-md-2" style="padding: 0px;text-align: center;">
        <h4>Línea 4 -></h4>
      </div>
<div class="col-md-10">

        <input type="number" class="form-control" name="inputBrazo1" value="0" placeholder="línea 4">
      </div>



    </div>
</div>  -->    
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
    <div class="form-group" style="padding-top: 30px;"> 

 <button type="button" class="btn btn-warning btn-lg" id="btn-1" style="padding-left:40%;padding-right: 40%;">Confirmar Datos</button>

 <button type="button" class="btn btn-warning btn-lg" id="btn-3" style="padding-left:40%;padding-right: 40%;display: none">Cargando... <img src="1.gif" style="opacity: 1;width: 25%; 
    left: 0px;
    top: 0px;"></button>


      <!-- Submit Button -->
        <button  style='display: none;padding-left:40%;padding-right: 40%; 'type="submit" id='nuevo_formulario' class="btn btn-success btn-lg">Cargar Datos</button>
    </div>  



</div> 
    </div>
</form>



 


    </section>
    <!-- /.content -->
  </div>


 

   <!-- Contenido --> 


<!-- <script type="text/javascript">
  
 var cont=0;
function up(){ 

$("#nuevo_formulario2").submit(function (e) {
    e.preventDefault()

    var datos = new FormData($(this)[0])
console.log(datos)

  var contador = document.getElementById("contador");
  contador.value = cont;
  cont++;


    $.ajax({
      url: '../views/modules/tabla.php',
      type: 'POST',
      data: datos,
      processData: false,
      contentType: false,
      success: function(respuesta) {
        console.log(respuesta)
        if (respuesta == "ok") {
          swal({
            type: 'success',
            title: 'Excelente',
            text: 'Slider creado con éxito'
          }).then((result) => {
            if (result.value) {
              window.location = "slider"
            }
          })
        }
      }

    })

  })
}

 setInterval('up()', 1000);



</script> -->






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

<script type="text/javascript">
    

$(document).ready(function(){ 

    var i=1; 



    $('#add15').click(function(){
        i++;


        $('#dinami').append('<div style="margin-top:20px;" class="row" id="row00'+i+'">  <div class="col-md-2" style="padding: 0px;text-align: center;"><h4>Línea -></h4></div><div class="col-md-6"><input type="number" class="form-control" id="inputBrazo" name="inputBrazo[]" value="0" placeholder="línea 1"></div><div class="col-md-3"><select class="form-control" name="linea[]" id="linea" style="color: black;width: 100%;"><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></div><div class="col-md-1" >  <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove00" >-</button></div></div>');

    });
    


   


    $(document).on('click', '.btn_remove00', function(){
        var button_id = $(this).attr("id"); 
        $('#row00'+button_id+'').remove();
    });
    

    
});



</script>
   <script>


$('#btn-1').click(function(){


 $('#btn-1').hide(10);
  $('#nuevo_formulario').show(10);

  e.preventDefault();

          var contratista= document.getElementById("contratista").value;
          var fecha_inicial= document.getElementById("fecha_inicial").value;
          var inputBrazo= document.getElementById("inputBrazo").value;
          var linea= document.getElementById("linea").value;
          var CD_PONTO= document.getElementById("CD_PONTO").value;
          var isFirst= document.getElementById("isFirst").value;

console.log(inputBrazo);
console.log(linea);
console.log(CD_PONTO);
console.log(isFirst);
console.log(contratista);
console.log(fecha_inicial);




  

   $.ajax({

            method: 'POST',
            url: 'historial.php',
         
            data: {contratista:contratista,fecha_inicial:fecha_inicial,inputBrazo:inputBrazo,linea:linea,isFirst:isFirst,CD_PONTO:CD_PONTO} //Aquí tienes que enviar la información que necesita si no tiene nada puedes dejarlo así {}

 }).done(function(msg) {

                console.log(msg);
                 $('#tabla').html(msg);
            });




  
 

})


 

    </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>