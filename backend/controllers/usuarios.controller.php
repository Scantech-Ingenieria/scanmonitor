<?php

Class ControllerUsuarios {

	public function listarUsuariosCtr() {
		$tabla = "administrador";
		$respuesta = ModeloUsuarios::listarUsuariosMdl($tabla);

		return $respuesta;
	}

	static public function ctrCrearUsuarios($datos) {
		$tabla = "administrador";

		list($ancho, $alto) = getimagesize($datos["imagen"]["tmp_name"]);

		$nuevoAncho = 1024;
		$nuevoAlto = 768;

		$directorio = "../views/dist/img/administrador";

		if($datos["imagen"]["type"] == "image/jpeg"){

			$rutaImagen = $directorio."/".md5($datos["imagen"]["tmp_name"]).".jpeg";

			$origen = imagecreatefromjpeg($datos["imagen"]["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

			imagejpeg($destino, $rutaImagen);

		}

		if($datos["imagen"]["type"] == "image/png"){

			$rutaImagen = $directorio."/".md5($datos["imagen"]["name"]).".png";

			$origen = imagecreatefrompng($datos["imagen"]["tmp_name"]);

			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			imagealphablending($destino, FALSE);

			imagesavealpha($destino, TRUE);

			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

			imagepng($destino, $rutaImagen);

		}


		$respuesta = ModeloUsuarios::mdlCrearUsuarios($tabla, $datos, $rutaImagen);

		return $respuesta;

	}


	static public function ctrEliminarUsuarios($id_usuarios, $ruta) {

		$tabla = "administrador";

		if ( unlink($ruta) ) {

			$respuesta = ModeloUsuarios::mdlEliminarUsuarios($tabla, $id_usuarios);

		}

		return $respuesta;

	}

	static public function ctrEditarUsuarios($id_usuarios) {

		$tabla = "administrador";
		$respuesta = ModeloUsuarios::mdlEditarUsuarios($tabla, $id_usuarios);


		return $respuesta;
	}

	static public function ctrActualizarUsuarios($datos) {
		//Validamos si no viene imagen para actualizar solo la tabla
		$tabla = "administrador";

		if ($datos["imagen"]["error"] == 4) {
			$rutaImagen = null;

		}
		// LA ACTUALIZACIÓN VIENE CON IMAGEN
		else {

			unlink("../".$datos["rutaActual"]);

			list($ancho, $alto) = getimagesize($datos["imagen"]["tmp_name"]);

			$nuevoAncho = 1024;
			$nuevoAlto = 768;

			$directorio = "../views/dist/img/administrador";

			if($datos["imagen"]["type"] == "image/jpeg"){

				$rutaImagen = $directorio."/".md5($datos["imagen"]["tmp_name"]).".jpeg";

				$origen = imagecreatefromjpeg($datos["imagen"]["tmp_name"]);
				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $rutaImagen);

			}

			if($datos["imagen"]["type"] == "image/png"){

				$rutaImagen = $directorio."/".md5($datos["imagen"]["name"]).".png";

				$origen = imagecreatefrompng($datos["imagen"]["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagealphablending($destino, FALSE);

				imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $rutaImagen);

			}




		}

		$respuesta = ModeloUsuarios::mdlActualizarUsuarios($tabla, $datos, $rutaImagen);

		return $respuesta;

	}

}

?>