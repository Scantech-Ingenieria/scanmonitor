<?php 

require_once "../controllers/categorias.controller.php";
require_once "../models/categorias.modelo.php";

Class ajaxCategorias {

	public $id_categorias;
	public $titulo_categorias;
	public $descripcion_categorias;
	public $vinculo_categorias;
	public $rutaActual;

	public function crearCategorias(){
		$datos = array("titulo"=>$this->titulo_categorias,
						"vinculo"=>$this->vinculo_categorias
						);

		$respuesta = ControllerCategorias::ctrCrearCategorias($datos);

		echo $respuesta;
	}
	public function editarCategorias(){
		$id_categorias = $this->id_categorias;

		$respuesta = ControllerCategorias::ctrEditarCategorias($id_categorias);

		$datos = array("id_categorias"=>$respuesta["id"],
						"titulo_categorias"=>$respuesta["categoria"],
						"vinculo"=>$respuesta["ruta"]
						);

		echo json_encode($datos);

	}
	public function actualizarCategorias(){
		$datos = array( "id_categorias"=>$this->id_categorias,
						"titulo"=>$this->titulo_categorias,
						"descripcion"=>$this->descripcion_categorias,
						"vinculo"=>$this->vinculo_categorias,
						"rutaActual"=>$this->rutaActual
						);

		$respuesta = ControllerCategorias::ctrActualizarCategorias($datos);

		echo $respuesta;
	}
	public function eliminarCategorias(){
		$id_categorias = $this->id_categorias;

		$respuesta = ControllerCategorias::ctrEliminarCategorias($id_categorias);

		echo $respuesta;

	}

}

$tipoOperacion = $_POST["tipoOperacion"];

if($tipoOperacion == "insertarCategorias") {
	$crearNuevoCategorias = new ajaxCategorias();
	$crearNuevoCategorias -> titulo_categorias = $_POST["tituloCategorias"];
	$crearNuevoCategorias -> vinculo_categorias = $_POST["urlAmigable"];
	$crearNuevoCategorias ->crearCategorias();
}

if ($tipoOperacion == "editarCategorias") {
	$editarCategorias = new ajaxCategorias();
	$editarCategorias -> id_categorias = $_POST["id_categorias"];
	$editarCategorias -> editarCategorias();
}
if ($tipoOperacion == "actualizarCategorias") {
	$actualizarCategorias = new ajaxCategorias();
	$actualizarCategorias -> id_categorias = $_POST["id_categorias"];
	$actualizarCategorias -> titulo_categorias = $_POST["tituloCategorias"];
	$actualizarCategorias -> vinculo_categorias = $_POST["urlCategorias"];
	$actualizarCategorias -> rutaActual = $_POST["rutaActual"];
	$actualizarCategorias -> actualizarCategorias();
}
if ($tipoOperacion == "eliminarCategorias") {
	$eliminarCategorias = new ajaxCategorias();
	$eliminarCategorias -> id_categorias = $_POST["id_categorias"];
	$eliminarCategorias -> eliminarCategorias();
}

?>