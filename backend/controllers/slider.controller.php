<?php
error_reporting(0);


Class ControllerSlider {
	public function listarSliderCtr() {
		$tabla = "slider";
		$respuesta = ModeloSlider::listarSliderMdl($tabla);
		return $respuesta;
	}
	public function listarPesajeCtr() {
		$tabla = "pesaje";
		$respuesta = ModeloSlider::listarPesajeMdl($tabla);
		return $respuesta;
	}
	static public function ctrCrearSlider($datos) {
$localtime = localtime();

		$tabla = "slider";
		list($ancho, $alto) = getimagesize($datos["imagen"]["tmp_name"]);
		$nuevoAncho = 1024;
		$nuevoAlto = 768;
		$directorio = "../views/dist/img/slider";
		if($datos["imagen"]["type"] == "image/jpeg"){
			$rutaImagen = $directorio."/".md5($datos["imagen"]["name"])."_".$localtime[0].".jpeg";
			$origen = imagecreatefromjpeg($datos["imagen"]["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagejpeg($destino, $rutaImagen);
		}
         if($datos["imagen"]["type"] == "image/png"){
			$rutaImagen = $directorio."/".md5($datos["imagen"]["name"])."_".$localtime[0].".png";
			$origen = imagecreatefrompng($datos["imagen"]["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagealphablending($destino, FALSE);
			imagesavealpha($destino, TRUE);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagepng($destino, $rutaImagen);
		}
		if($datos["imagen"]["type"] == "video/mp4"){
	$rutaImagen = $directorio."/".md5($datos["imagen"]["name"])."_".$localtime[0].".mp4";
	$tmp_datos=$datos["imagen"]["tmp_name"];
				move_uploaded_file($tmp_datos, $rutaImagen);
		}
		if($datos["imagen"]["type"] == ""){
$rutaImagen="";

		}
		$respuesta = ModeloSlider::mdlCrearSlider($tabla, $datos, $rutaImagen);
		return $respuesta;
	}

	static public function ctrCrearPesaje($datos) {
		$tabla = "pesaje";
		$respuesta = ModeloSlider::mdlCrearPesaje($tabla, $datos);
		return $respuesta;
	}
	static public function ctrEliminarSlider($id_slider, $ruta) {
		$tabla = "slider";
if ($ruta!='') {
		unlink($ruta);
		}
			$respuesta = ModeloSlider::mdlEliminarSlider($tabla, $id_slider);
		
		return $respuesta;
	}
	static public function ctrEditarSlider($id_slider) {
		$tabla = "slider";
		$respuesta = ModeloSlider::mdlEditarSlider($tabla, $id_slider);
		return $respuesta;
	}
	static public function ctrActualizarSlider($datos) {
		//Validamos si no viene imagen para actualizar solo la tabla
		$tabla = "slider";
		
		$respuesta = ModeloSlider::mdlActualizarSlider($tabla, $datos);
		return $respuesta;
	}
}

?>