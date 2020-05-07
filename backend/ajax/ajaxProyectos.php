<?php

require_once "../controllers/proyectos.controller.php";
require_once "../models/proyectos.modelo.php";

Class ajaxProyectos {

	public $id_proyectos;
	public $titulo_proyectos;
	public $subtitulo_proyectos;

	public $descripcion_proyectos;
	public $vinculo_proyectos;
	public $imagen_proyectos;
	public $rutaActual;

	public function crearProyectos(){
		$datos = array("titulo"=>$this->titulo_proyectos,
			"subtitulo"=>$this->subtitulo_proyectos,
						"descripcion"=>$this->descripcion_proyectos,
						"vinculo"=>$this->vinculo_proyectos,
						"imagen"=>$this->imagen_proyectos);

		$respuesta = ControllerProyectos::ctrCrearProyectos($datos);

		echo $respuesta;
	}
	public function editarProyectos(){
		$id_proyectos = $this->id_proyectos;

		$respuesta = ControllerProyectos::ctrEditarProyectos($id_proyectos);

		$datos = array("id_proyectos"=>$respuesta["id_proyectos"],
						"titulo_proyectos"=>$respuesta["titulo"],
						"subtitulo_proyectos"=>$respuesta["subtitulo"],
						"descripcion"=>$respuesta["descripcion"],
						"imagen"=>substr($respuesta["rutaImg"], 3)
						);

		echo json_encode($datos);

	}
	public function actualizarProyectos(){
		$datos = array( "id_proyectos"=>$this->id_proyectos,
						"titulo"=>$this->titulo_proyectos,
						"subtitulo"=>$this->subtitulo_proyectos,

						"descripcion"=>$this->descripcion_proyectos,
						"imagen"=>$this->imagen_proyectos,
						"rutaActual"=>$this->rutaActual
						);

		$respuesta = ControllerProyectos::ctrActualizarProyectos($datos);

		echo $respuesta;
	}
	public function eliminarProyectos(){
		$id_proyectos = $this->id_proyectos;
		$ruta = $this->imagen_proyectos;

		$respuesta = ControllerProyectos::ctrEliminarProyectos($id_proyectos, $ruta);

		echo $respuesta;

	}

}

$tipoOperacion = $_POST["tipoOperacion"];

if($tipoOperacion == "insertarProyectos") {
	$crearNuevoProyectos = new ajaxProyectos();
	$crearNuevoProyectos -> titulo_proyectos = $_POST["tituloProyectos"];
	$crearNuevoProyectos -> subtitulo_proyectos = $_POST["SubtituloProyectos"];
	$crearNuevoProyectos -> descripcion_proyectos = $_POST["descripcionProyectos"];
	$crearNuevoProyectos -> imagen_proyectos = $_FILES["imagenProyectos"];
	$crearNuevoProyectos ->crearProyectos();
}

if ($tipoOperacion == "editarProyectos") {
	$editarProyectos = new ajaxProyectos();
	$editarProyectos -> id_proyectos = $_POST["id_proyectos"];
	$editarProyectos -> editarProyectos();
}
if ($tipoOperacion == "actualizarProyectos") {
	$actualizarProyectos = new ajaxProyectos();
	$actualizarProyectos -> id_proyectos = $_POST["id_proyectos"];
	$actualizarProyectos -> titulo_proyectos = $_POST["tituloProyectos"];
	$actualizarProyectos -> subtitulo_proyectos = $_POST["SubtituloProyectos"];
	$actualizarProyectos -> descripcion_proyectos = $_POST["descripcionProyectos"];
	$actualizarProyectos -> imagen_proyectos = $_FILES["imagenProyectos"];
	$actualizarProyectos -> rutaActual = $_POST["rutaActual"];
	$actualizarProyectos -> actualizarProyectos();
}
if ($tipoOperacion == "eliminarProyectos") {
	$eliminarProyectos = new ajaxProyectos();
	$eliminarProyectos -> id_proyectos = $_POST["id_proyectos"];
	$eliminarProyectos -> imagen_proyectos = $_POST["rutaImagen"];
	$eliminarProyectos -> eliminarProyectos();
}

?>