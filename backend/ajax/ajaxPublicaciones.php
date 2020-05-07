<?php

require_once "../controllers/publicaciones.controller.php";
require_once "../models/publicaciones.modelo.php";

Class ajaxPublicaciones {

	public $id_publicaciones;
	public $titulo_publicaciones;
	public $subtitulo_publicaciones;

	public $descripcion_publicaciones;
	public $vinculo_publicaciones;
	public $imagen_publicaciones;
	public $rutaActual;

	public function crearPublicaciones(){
		$datos = array("titulo"=>$this->titulo_publicaciones,
			"subtitulo"=>$this->subtitulo_publicaciones,
			"autor"=>$this->autor_publicaciones,

						"descripcion"=>$this->descripcion_publicaciones,
						"vinculo"=>$this->vinculo_publicaciones,
						"imagen"=>$this->imagen_publicaciones);

		$respuesta = ControllerPublicaciones::ctrCrearPublicaciones($datos);

		echo $respuesta;
	}
	public function editarPublicaciones(){
		$id_publicaciones = $this->id_publicaciones;

		$respuesta = ControllerPublicaciones::ctrEditarPublicaciones($id_publicaciones);

		$datos = array("id_publicaciones"=>$respuesta["id_publicaciones"],
						"titulo_publicaciones"=>$respuesta["titulo"],
						"subtitulo_publicaciones"=>$respuesta["subtitulo"],
						"autor_publicaciones"=>$respuesta["autor"],

						"descripcion"=>$respuesta["descripcion"],
						"imagen"=>substr($respuesta["rutaImg"], 3)
						);

		echo json_encode($datos);

	}
	public function actualizarPublicaciones(){
		$datos = array( "id_publicaciones"=>$this->id_publicaciones,
						"titulo"=>$this->titulo_publicaciones,
						"subtitulo"=>$this->subtitulo_publicaciones,
			       "autor"=>$this->autor_publicaciones,

						"descripcion"=>$this->descripcion_publicaciones,
						"imagen"=>$this->imagen_publicaciones,
						"rutaActual"=>$this->rutaActual
						);

		$respuesta = ControllerPublicaciones::ctrActualizarPublicaciones($datos);

		echo $respuesta;
	}
	public function eliminarPublicaciones(){
		$id_publicaciones = $this->id_publicaciones;
		$ruta = $this->imagen_publicaciones;

		$respuesta = ControllerPublicaciones::ctrEliminarPublicaciones($id_publicaciones, $ruta);

		echo $respuesta;

	}

}

$tipoOperacion = $_POST["tipoOperacion"];

if($tipoOperacion == "insertarPublicaciones") {
	$crearNuevoPublicaciones = new ajaxPublicaciones();
	$crearNuevoPublicaciones -> titulo_publicaciones = $_POST["tituloPublicaciones"];
	$crearNuevoPublicaciones -> subtitulo_publicaciones = $_POST["SubtituloPublicaciones"];
	$crearNuevoPublicaciones -> autor_publicaciones = $_POST["AutorPublicaciones"];

	$crearNuevoPublicaciones -> descripcion_publicaciones = $_POST["descripcionPublicaciones"];
	$crearNuevoPublicaciones -> imagen_publicaciones = $_FILES["imagenPublicaciones"];
	$crearNuevoPublicaciones ->crearPublicaciones();
}

if ($tipoOperacion == "editarPublicaciones") {
	$editarPublicaciones = new ajaxPublicaciones();
	$editarPublicaciones -> id_publicaciones = $_POST["id_publicaciones"];
	$editarPublicaciones -> editarPublicaciones();
}
if ($tipoOperacion == "actualizarPublicaciones") {
	$actualizarPublicaciones = new ajaxPublicaciones();
	$actualizarPublicaciones -> id_publicaciones = $_POST["id_publicaciones"];
	$actualizarPublicaciones -> titulo_publicaciones = $_POST["tituloPublicaciones"];
	$actualizarPublicaciones -> subtitulo_publicaciones = $_POST["SubtituloPublicaciones"];
	$actualizarPublicaciones -> autor_publicaciones = $_POST["AutorPublicaciones"];

	$actualizarPublicaciones -> descripcion_publicaciones = $_POST["descripcionPublicaciones"];
	$actualizarPublicaciones -> imagen_publicaciones = $_FILES["imagenPublicaciones"];
	$actualizarPublicaciones -> rutaActual = $_POST["rutaActual"];
	$actualizarPublicaciones -> actualizarPublicaciones();
}
if ($tipoOperacion == "eliminarPublicaciones") {
	$eliminarPublicaciones = new ajaxPublicaciones();
	$eliminarPublicaciones -> id_publicaciones = $_POST["id_publicaciones"];
	$eliminarPublicaciones -> imagen_publicaciones = $_POST["rutaImagen"];
	$eliminarPublicaciones -> eliminarPublicaciones();
}

?>