<?php

require_once "../controllers/inicio.controller.php";
require_once "../models/inicio.modelo.php";

Class ajaxInicio {

	public $id_inicio;
	public $titulo_producto;
	public $rutaActual;


	public function editarInicio(){
		$id_inicio = $this->id_Inicio;
		$respuesta = ControllerInicio::ctrEditarInicio($id_inicio);

		$datos = array("id_info"=>$respuesta["id_info"],
						"informacion"=>$respuesta["informacion"],
						);

		echo json_encode($datos);

	}
	public function actualizarInicio(){
		$datos = array( "id_info"=>$this->id_Inicio,
						"informacion"=>$this->informacion,

						);

		$respuesta = ControllerInicio::ctrActualizarInicio($datos);

		echo $respuesta;
	}


}

$tipoOperacion = $_POST["tipoOperacion"];



if ($tipoOperacion == "editarInicio") {
	$editarInicio = new ajaxInicio();
	$editarInicio -> id_Inicio = $_POST["id_Inicio"];

	$editarInicio -> editarInicio();
}
if ($tipoOperacion == "actualizarInicio") {
	$actualizarInicio = new ajaxInicio();
	$actualizarInicio -> id_Inicio = $_POST["id_Inicio"];
	$actualizarInicio -> informacion = $_POST["descripcionInicio"];

	$actualizarInicio -> actualizarInicio();
}


?>