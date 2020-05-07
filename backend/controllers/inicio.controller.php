<?php

Class ControllerInicio {

	public function listarInicioCtr() {
		$tabla = "inicio";
		$respuesta = ModeloInicio::listarInicioMdl($tabla);

		return $respuesta;
	}


	static public function ctrEditarInicio($id_inicio) {

		$tabla = "inicio";
		$respuesta = ModeloInicio::mdlEditarInicio($tabla, $id_inicio);


		return $respuesta;
	}

	static public function ctrActualizarInicio($datos) {
		//Validamos si no viene imagen para actualizar solo la tabla
		$tabla = "inicio";

		$respuesta = ModeloInicio::mdlActualizarInicio($tabla, $datos);

		return $respuesta;

	}
}

?>