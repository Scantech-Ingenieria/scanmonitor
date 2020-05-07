<?php

require_once "../controllers/slider.controller.php";
require_once "../models/slider.modelo.php";

Class ajaxSlider {

	public $id_slider;
		public $imagen_slider;
	public $rutaActual;

	public function crearSlider(){
		$datos = array(
						
						"imagen"=>$this->imagen_slider,
						"extension"=>$this->extension,
						"tiempo"=>$this->tiempo,
						"titulo"=>$this->titulo


					);

		$respuesta = ControllerSlider::ctrCrearSlider($datos);

		echo $respuesta;
	}
	public function editarSlider(){
		$id_slider = $this->id_slider;

		$respuesta = ControllerSlider::ctrEditarSlider($id_slider);

		$datos = array("id_slider"=>$respuesta["id"],
					
						"imagen"=>substr($respuesta["rutaImg"], 3)
						);

		echo json_encode($datos);

	}
	public function actualizarSlider(){
		$datos = array( "id_slider"=>$this->id_slider,
			
						"imagen"=>$this->imagen_slider,
						"rutaActual"=>$this->rutaActual
						);

		$respuesta = ControllerSlider::ctrActualizarSlider($datos);

		echo $respuesta;
	}
	public function eliminarSlider(){
		$id_slider = $this->id_slider;
		$ruta = $this->imagen_slider;

		$respuesta = ControllerSlider::ctrEliminarSlider($id_slider, $ruta);

		echo $respuesta;

	}

}

$tipoOperacion = $_POST["tipoOperacion"];

if($tipoOperacion == "insertarSlider") {
	$crearNuevoSlider = new ajaxSlider();


	$crearNuevoSlider -> imagen_slider = $_FILES["imagenSlider"];
	$crearNuevoSlider -> extension = $_POST["extension"];
	$crearNuevoSlider -> tiempo = $_POST["tiempo"];
	$crearNuevoSlider -> titulo = $_POST["titulo"];


	$crearNuevoSlider ->crearSlider();
}

if ($tipoOperacion == "editarSlider") {
	$editarSlider = new ajaxSlider();
	$editarSlider -> id_slider = $_POST["id_slider"];
	$editarSlider -> editarSlider();
}
if ($tipoOperacion == "actualizarSlider") {
	$actualizarSlider = new ajaxSlider();
	$actualizarSlider -> id_slider = $_POST["id_slider"];



	$actualizarSlider -> imagen_slider = $_FILES["imagenSlider"];
	$actualizarSlider -> rutaActual = $_POST["rutaActual"];
	$actualizarSlider -> actualizarSlider();
}
if ($tipoOperacion == "eliminarSlider") {
	$eliminarSlider = new ajaxSlider();
	$eliminarSlider -> id_slider = $_POST["id_slider"];
	$eliminarSlider -> imagen_slider = $_POST["rutaImagen"];
	$eliminarSlider -> eliminarSlider();
}

?>