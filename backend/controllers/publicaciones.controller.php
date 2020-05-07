<?php

Class ControllerPublicaciones {

	public function listarPublicacionesCtr() {
		$tabla = "publicaciones";
		$respuesta = ModeloPublicaciones::listarPublicacionesMdl($tabla);

		return $respuesta;
	}

	static public function ctrCrearPublicaciones($datos) {
		$tabla = "publicaciones";

		list($ancho, $alto) = getimagesize($datos["imagen"]["tmp_name"]);

		$nuevoAncho = 1024;
		$nuevoAlto = 768;

		$publicaciones = "../views/dist/img/publicaciones";

		if($datos["imagen"]["type"] == "image/jpeg"){

			$rutaImagen = $publicaciones."/".md5($datos["imagen"]["tmp_name"]).".jpeg";

			$origen = imagecreatefromjpeg($datos["imagen"]["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

			imagejpeg($destino, $rutaImagen);

		}

		if($datos["imagen"]["type"] == "image/png"){

			$rutaImagen = $publicaciones."/".md5($datos["imagen"]["name"]).".png";

			$origen = imagecreatefrompng($datos["imagen"]["tmp_name"]);

			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			imagealphablending($destino, FALSE);

			imagesavealpha($destino, TRUE);

			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

			imagepng($destino, $rutaImagen);

		}


		$respuesta = ModeloPublicaciones::mdlCrearPublicaciones($tabla, $datos, $rutaImagen);

		return $respuesta;

	}

	static public function ctrEliminarPublicaciones($id_publicaciones, $ruta) {

		$tabla = "publicaciones";

		if ( unlink($ruta) ) {

			$respuesta = ModeloPublicaciones::mdlEliminarPublicaciones($tabla, $id_publicaciones);

		}

		return $respuesta;

	}

	static public function ctrEditarPublicaciones($id_publicaciones) {

		$tabla = "publicaciones";
		$respuesta = ModeloPublicaciones::mdlEditarPublicaciones($tabla, $id_publicaciones);


		return $respuesta;
	}

	static public function ctrActualizarPublicaciones($datos) {
		//Validamos si no viene imagen para actualizar solo la tabla
		$tabla = "publicaciones";

		if ($datos["imagen"]["error"] == 4) {
			$rutaImagen = null;

		}
		// LA ACTUALIZACIÓN VIENE CON IMAGEN
		else {

			unlink("../".$datos["rutaActual"]);

			list($ancho, $alto) = getimagesize($datos["imagen"]["tmp_name"]);

			$nuevoAncho = 1024;
			$nuevoAlto = 768;

			$publicaciones = "../views/dist/img/publicaciones";

			if($datos["imagen"]["type"] == "image/jpeg"){

				$rutaImagen = $publicaciones."/".md5($datos["imagen"]["tmp_name"]).".jpeg";

				$origen = imagecreatefromjpeg($datos["imagen"]["tmp_name"]);
				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $rutaImagen);

			}

			if($datos["imagen"]["type"] == "image/png"){

				$rutaImagen = $publicaciones."/".md5($datos["imagen"]["name"]).".png";

				$origen = imagecreatefrompng($datos["imagen"]["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagealphablending($destino, FALSE);

				imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $rutaImagen);

			}




		}

		$respuesta = ModeloPublicaciones::mdlActualizarPublicaciones($tabla, $datos, $rutaImagen);

		return $respuesta;

	}
}

?>