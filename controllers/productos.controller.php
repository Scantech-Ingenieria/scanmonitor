<?php

class ControllerProductos {



	static public function ctrMostrarUltimos4Prod () {

		$tabla = "productos";

		$respuesta = ModelProductos::mdlMostrarUltimos4Prod($tabla);

		return $respuesta;

	}

	static public function ctrMostrarCategorias ($columna,$valor) {

		$tabla = "categorias";

		$respuesta = ModelProductos::mdlMostrarCategorias($tabla,$columna,$valor);

		return $respuesta;

	}

	static public function ctrMostrarSubCategorias($columna,$valor) {

		$tabla = "subcategorias";

		$respuesta = ModelProductos::mdlMostrarSubCategorias($tabla, $columna,$valor);

		return $respuesta;
	}

	static public function ctrMostrarBanner() {
		$tabla = "slider";
		$respuesta = ModelProductos::mdlMostrarBaner($tabla);
		return $respuesta;
	}
		static public function ctrMostrarInfoInicio() {
		$tabla = "inicio";
		$respuesta = ModelProductos::mdlMostrarInfoInicio($tabla);
		return $respuesta;
	}
		static public function ctrMostrarInfoVision() {
		$tabla = "fundacion";
		$respuesta = ModelProductos::mdlMostrarInfoVision($tabla);
		return $respuesta;
	}
		static public function ctrMostrarInfoMision() {
		$tabla = "fundacion";
		$respuesta = ModelProductos::mdlMostrarInfoMision($tabla);
		return $respuesta;
	}
		static public function ctrMostrarInfoHacemos() {
		$tabla = "fundacion";
		$respuesta = ModelProductos::mdlMostrarInfoHacemos($tabla);
		return $respuesta;
	}
		static public function ctrMostrarInfoQue() {
		$tabla = "victimas";
		$respuesta = ModelProductos::mdlMostrarInfoQue($tabla);
		return $respuesta;
	}
		static public function ctrMostrarInfoPorque() {
		$tabla = "victimas";
		$respuesta = ModelProductos::mdlMostrarInfoPorque($tabla);
		return $respuesta;
	}
	static public function ctrMostrarInfoPrevencion() {
		$tabla = "delitos";
		$respuesta = ModelProductos::mdlMostrarInfoPrevencion($tabla);
		return $respuesta;
	}
		static public function ctrMostrarInfoPersecucion() {
		$tabla = "delitos";
		$respuesta = ModelProductos::mdlMostrarInfoPersecucion($tabla);
		return $respuesta;
	}
			static public function ctrMostrarInfoEstudios() {
		$tabla = "estudios";
		$respuesta = ModelProductos::mdlMostrarInfoEstudios($tabla);
		return $respuesta;
	}
				static public function ctrMostrarDirectorio() {
		$tabla = "directorio";
		$respuesta = ModelProductos::mdlMostrarDirectorio($tabla);
		return $respuesta;
	}
					static public function ctrMostrarOrganigrama() {
		$tabla = "organigrama";
		$respuesta = ModelProductos::mdlMostrarOrganigrama($tabla);
		return $respuesta;
	}
		static public function ctrMostrarProyectos() {
		$tabla = "proyectos";
		$respuesta = ModelProductos::mdlMostrarProyectos($tabla);
		return $respuesta;
	}
			static public function ctrMostrarDetallesProyectos($valor) {
		$tabla = "proyectos";
		$respuesta = ModelProductos::mdlMostrarDetallesProyectos($tabla,$valor);
		return $respuesta;
	}
		static public function ctrMostrarBlog() {
		$tabla = "blog";
		$respuesta = ModelProductos::mdlMostrarBlog($tabla);
		return $respuesta;
	}
			static public function ctrMostrarDetallesBlog($valor) {
		$tabla = "blog";
		$respuesta = ModelProductos::mdlMostrarDetallesBlog($tabla,$valor);
		return $respuesta;
	}
			static public function ctrMostrarHacemos() {
		$tabla = "hacemos";
		$respuesta = ModelProductos::mdlMostrarHacemos($tabla);
		return $respuesta;
	}
				static public function ctrMostrarRepre() {
		$tabla = "representacion";
		$respuesta = ModelProductos::mdlMostrarRepre($tabla);
		return $respuesta;
	}

		static public function ctrMostrarPublicaciones() {
		$tabla = "publicaciones";
		$respuesta = ModelProductos::mdlMostrarPublicaciones($tabla);
		return $respuesta;
	}
			static public function ctrMostrarDetallesPublicaciones($valor) {
		$tabla = "publicaciones";
		$respuesta = ModelProductos::mdlMostrarDetallesPublicaciones($tabla,$valor);
		return $respuesta;
	}

		static public function ctrMostrarReparacion() {
		$tabla = "reparacion";
		$respuesta = ModelProductos::mdlMostrarReparacion($tabla);
		return $respuesta;
	}
}
?>
