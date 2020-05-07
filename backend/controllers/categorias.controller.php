<?php 

Class ControllerCategorias {
	
	public function listarCategoriasCtr() {
		$tabla = "categorias";
		$respuesta = ModeloCategorias::listarCategoriasMdl($tabla);

		return $respuesta;
	}

	static public function ctrCrearCategorias($datos) {
		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlCrearCategorias($tabla, $datos);

		return $respuesta;

	}

	static public function ctrEliminarCategorias($id_categorias) {

		$tabla = "categorias";

	
		
			$respuesta = ModeloCategorias::mdlEliminarCategorias($tabla, $id_categorias);	
		

		
		return $respuesta;

	}

	static public function ctrEditarCategorias($id_categorias) {

		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlEditarCategorias($tabla, $id_categorias);


		return $respuesta;
	}

	static public function ctrActualizarCategorias($datos) {
		//Validamos si no viene imagen para actualizar solo la tabla
		$tabla = "categorias";


		$respuesta = ModeloCategorias::mdlActualizarCategorias($tabla, $datos);

		return $respuesta;

	}
}

?>