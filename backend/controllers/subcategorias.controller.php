<?php 

Class ControllersubCategorias {
	
	public function listarsubCategoriasCtr() {
		$tabla = "subcategorias";
		$respuesta = ModelosubCategorias::listarsubCategoriasMdl($tabla);

		return $respuesta;
	}

	static public function ctrCrearsubCategorias($datos) {
		$tabla = "subcategorias";

		list($ancho, $alto) = getimagesize($datos["imagen"]["tmp_name"]);	

		$nuevoAncho = 1024;
		$nuevoAlto = 768;

		$directorio = "../views/dist/img/subcategorias";

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


		$respuesta = ModelosubCategorias::mdlCrearsubCategorias($tabla, $datos, $rutaImagen);

		return $respuesta;

	}

	static public function ctrEliminarsubCategorias($id_subcategorias, $ruta) {

		$tabla = "subcategorias";

		if ( unlink($ruta) ) {
		
			$respuesta = ModelosubCategorias::mdlEliminarsubCategorias($tabla, $id_subcategorias);	
		
		}
		
		return $respuesta;

	}

	static public function ctrEditarsubCategorias($id_subcategorias) {

		$tabla = "subcategorias";
		$respuesta = ModelosubCategorias::mdlEditarsubCategorias($tabla, $id_subcategorias);


		return $respuesta;
	}

	static public function ctrActualizarsubCategorias($datos) {
		//Validamos si no viene imagen para actualizar solo la tabla
		$tabla = "subcategorias";

		if ($datos["imagen"]["error"] == 4) {
			$rutaImagen = null;

		} 
		// LA ACTUALIZACIÓN VIENE CON IMAGEN
		else {

			unlink(".".$datos["rutaActual"]);
			
			list($ancho, $alto) = getimagesize($datos["imagen"]["tmp_name"]);	

			$nuevoAncho = 1024;
			$nuevoAlto = 768;

			$directorio = "../views/dist/img/subcategorias";

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

		$respuesta = ModelosubCategorias::mdlActualizarsubCategorias($tabla, $datos, $rutaImagen);

		return $respuesta;

	}
}

?>