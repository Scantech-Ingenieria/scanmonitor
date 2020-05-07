<?php

class ControllerEnrutamiento {

	public function enrutamiento() {

		$ruta = $_GET["ruta"];

		if ($ruta == "home" ||
			$ruta == "slider" ||
			$ruta == "categorias" ||
			$ruta == "subcategorias" ||
			$ruta == "productos" ||
			$ruta == "usuarios" ||
			$ruta == "inicio" ||
			$ruta == "fundacion" ||
			$ruta == "victimas" ||
			$ruta == "delitos" ||
			$ruta == "estudios" ||
			$ruta == "directorio" ||
			$ruta == "organigrama" ||
			$ruta == "proyectos" ||
			$ruta == "blog" ||
			$ruta == "hacemos" ||
			$ruta == "representacion" ||
			$ruta == "publicaciones" ||
			$ruta == "reparacion" ||
			$ruta == "ordenarslider" ||
			$ruta == "formulario" ||
			$ruta == "historial" ||

















			$ruta == "salir") {

			include "views/modulos/".$ruta.".php";

		} else {
			include "views/modulos/error404.php";
		}


	}
}

?>