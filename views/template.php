<!doctype html>

<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
    $urlFrontEnd=Rutas::urlFrontEnd();
    $urlBackEnd=Rutas::urlBackEnd();

    ?>
       <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Nixie+One&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Raleway:400i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $urlFrontEnd; ?>views/css/estilos_1.7.css">
    <link rel="stylesheet" href="<?php echo $urlFrontEnd; ?>views/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="views/css/styletable.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script type="text/javascript"src="<?php echo $urlFrontEnd; ?>views/js/bootsnav.js"></script>
   
    <script type="text/javascript" src="<?php echo $urlFrontEnd; ?>views/js/vue.js"></script>
    <script type="text/javascript" src="<?php echo $urlFrontEnd; ?>views/js/header.js"></script>  
   <script type="text/javascript"src="<?php echo $urlFrontEnd; ?>views/js/bootstrap.js"></script>

  </head>
  <body>

 
    <?php
      if( isset($_GET["ruta"])) {

        $enrutar = new Controllerrumiento();
        $enrutar -> enmiento();
      } else {
  include "modules/slider.php";
   include"conns.php";
      }
    ?>
  <script>
      $(window).scroll(function() {
        if ($("#menu").offset().top > 56) {
            $("#menu").addClass("tema2");
        } else {
            $("#menu").removeClass("tema2");
        }
      });

      $('.carousel').carousel({
  interval: 100 * 10
});
      
    </script>
<script>
  $(window).scroll(function() {
    $('#objet').each(function(){
    var imagePos = $(this).offset().top;

    var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+700) {
        $(this).addClass("slideUp");
      }
    });
  });
</script>

  </body>
</html>

 