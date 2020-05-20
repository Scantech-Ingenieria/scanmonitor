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
						"titulo"=>$this->titulo,
						"excel"=>$this->excel

					);
		$respuesta = ControllerSlider::ctrCrearSlider($datos);
		echo $respuesta;
	}
		public function crearPesaje(){
		$datos = array(
						
						"contratista"=>$this->contratista,
						"fecha"=>$this->fecha,
						"brazo4"=>$this->brazo4,
						"brazo3"=>$this->brazo3,
						"brazo2"=>$this->brazo2,
						"brazo1"=>$this->brazo1,
						"first"=>$this->first,
						"ponto"=>$this->ponto
					);
		$respuesta = ControllerSlider::ctrCrearPesaje($datos);
		echo $respuesta;
	}
	public function editarSlider(){
		$id_slider = $this->id_slider;
		$respuesta = ControllerSlider::ctrEditarSlider($id_slider);
		$datos = array("id_slider"=>$respuesta["id"],
			            "titulo"=>$respuesta["titulo"],
			            "excel"=>$respuesta["excel"],
			            "extension"=>$respuesta["extension"],		            

						"tiempo"=>miles($respuesta["tiempo"])	
						);
		echo json_encode($datos);

	}
	public function actualizarSlider(){
		$datos = array( "id_slider"=>$this->id_slider,
					"segundos"=>$this->segundos,
						"titulo"=>$this->titulo,
						"excel"=>$this->excel

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
	$crearNuevoSlider -> imagen_slider = $_FILES["archivo"];
	$crearNuevoSlider -> extension = $_POST["extension"];
	$crearNuevoSlider -> tiempo = $_POST["tiempo"];
	$crearNuevoSlider -> titulo = $_POST["titulo"];
	$crearNuevoSlider -> excel = $_POST["excels"];	
	$crearNuevoSlider ->crearSlider();
}
if($tipoOperacion == "insertarPesaje") {
	$crearNuevoPesaje = new ajaxSlider();
	$crearNuevoPesaje -> contratista = $_POST['inputContratista'];
	$crearNuevoPesaje -> fecha = $_POST['fecha_inicial'];
	$crearNuevoPesaje -> brazo4 = $_POST['inputBrazo3'];
	$crearNuevoPesaje -> brazo3 = $_POST['inputBrazo2'];
	$crearNuevoPesaje -> brazo2= $_POST['inputBrazo1'];
	$crearNuevoPesaje -> brazo1 = $_POST['inputBrazo0'];
	$crearNuevoPesaje -> first = $_POST['isFirst'];
	$crearNuevoPesaje -> ponto = $_POST['CD_PONTO'];
	$crearNuevoPesaje ->crearPesaje();
}
if ($tipoOperacion == "editarSlider") {
	$editarSlider = new ajaxSlider();
	$editarSlider -> id_slider = $_POST["id_slider"];
	$editarSlider -> editarSlider();
}
if ($tipoOperacion == "actualizarSlider") {
	$actualizarSlider = new ajaxSlider();
	$actualizarSlider -> id_slider = $_POST["id_slider"];
	$actualizarSlider -> segundos = multiplicar($_POST["segundos"]);
	$actualizarSlider -> titulo = $_POST["titulo"];
	$actualizarSlider -> actualizarSlider();
}
if ($tipoOperacion == "eliminarSlider") {
	$eliminarSlider = new ajaxSlider();
	$eliminarSlider -> id_slider = $_POST["id_slider"];
	$eliminarSlider -> imagen_slider = $_POST["rutaImagen"];
	$eliminarSlider -> eliminarSlider();
}
function miles($m){
$m=($m/1000);
return $m;
}
function multiplicar($m){
$m=($m*1000);
return $m;
}
?>