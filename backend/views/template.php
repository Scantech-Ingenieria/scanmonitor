<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ScanMonitor</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <script src="views/bower_components/jquery.min.js"></script>
<script src="views/bower_components/bootstrap.min.js"></script>
<script src="views/dist/js/adminlte.min.js"></script>
<script src="views/dist/js/flatpickr.js"></script>
<script src="views/dist/plugins/iCheck/icheck.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" href="views/bower_components/bootstrap.min.css">
  <link rel="stylesheet" href="views/bower_components/font-awesome.min.css">
  <link rel="stylesheet" href="views/bower_components/ionicons.min.css">
  <link rel="stylesheet" href="views/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="views/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="views/dist/plugins/iCheck/square/blue.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>

<style type="text/css">/*Lo mostramos 'hidden' por default*/
.ventana {
    display:    none;
    position:   fixed;
    z-index:    9999999;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba(255, 255, 255,0.08)
                url(views/dist/img/loading2.gif)
                50% 50%
                no-repeat;
}
/* Cuando el body tiene la clase 'loading' ocultamos la barra de navegacion */
body.loading {
    overflow: hidden;  
}

/* Siempre que el body tenga la clase 'loading' mostramos el modal del loading */
body.loading .ventana {
    display: block;
}</style>
<body class="hold-transition skin-blue sidebar-mini login-page">

<div class='ventana'></div>


  <?php
    session_start();
    if (isset($_SESSION["autenticar"]) && $_SESSION["autenticar"] == "ok") {
      include "modulos/header.php";
      include "modulos/main-sidebar.php";
      if( isset($_GET["ruta"])) {
        $enrutar = new ControllerEnrutamiento();
        $enrutar -> enrutamiento();
        include "modulos/modales/modales-".$_GET["ruta"].".php";
      } else {
        include "modulos/slider.php";
      }
      include "modulos/footer.php";
    } else {
        echo '<script>
            window.location = "../index.php"
          </script>';
    
    }
  ?>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
    <script>
      $(document).ready(function(){
        $("#datetime-inicial").flatpickr({
            enableTime: true,
            time_24hr: true,
            disableMobile: false,
            allowInput: true
        });

        
      });
    </script>

<script src="views/dist/js/slider.js"></script>
<script src="views/dist/js/rutaAmigable.js"></script>
<script src="views/dist/js/usuarios.js"></script>
<script src="views/dist/js/inicio.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/dist/sweetalert2.all.min.js"></script></body>
</html>