<div class="row perfil">
	<h2 style="margin-left:20px;">Directorio</h2>
        <?php
    $urlBackEnd=Rutas::urlBackEnd();
$prueba = ControllerProductos::ctrMostrarDirectorio();
        foreach ($prueba as $key => $value) {
          echo '
<div class="row contr">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
		 <img src="'.$urlBackEnd.substr($value["rutaImg"], 3).'" alt="">
	</div>
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
		<h4>'.nl2br($value["titulo"]).'</h4>
		<h6>'.nl2br($value["subtitulo"]).'</h6>
		<p style="text-align: justify;">'.nl2br($value["descripcion"]).'</p>
	</div>
</div>
          ';
        }

        ?>

</div>