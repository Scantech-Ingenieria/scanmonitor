<?php

class Controllerrumiento {

	public function enmiento() {

		$ruta = $_GET["ruta"];

		if ($ruta == "index" ||
			$ruta == "nosotros" ||
			$ruta == "equipo" ||
			$ruta == "vision" ||
			$ruta == "mision" ||
			$ruta == "estudios" ||
			$ruta == "formacion" ||
			$ruta == "trabajanosotros" ||
			$ruta == "contacto" ||
			$ruta == "ubicacion" ||
			$ruta == "consultoria" ||
			$ruta == "apoyanos" ||
			$ruta == "organigrama" ||
			$ruta == "hacemos" ||
			$ruta == "porque" ||
			$ruta == "que" ||
			$ruta == "prevencion" ||
			$ruta == "persecucion" ||
			$ruta == "proyectos" ||
			$ruta == "blog" ||
			$ruta == "detallesproyecto" ||
			$ruta == "detallesblog" ||
			$ruta == "representacion" ||
			$ruta == "reparacion" ||

			$ruta == "publicaciones" ||
			$ruta == "detallespublicaciones" ||
			$ruta == "tabla" ||












			$ruta == "representacion") {

			include "views/modules/".$ruta.".php";

		} else {
			include "views/modules/error404.php";
		}


	}
}

?>