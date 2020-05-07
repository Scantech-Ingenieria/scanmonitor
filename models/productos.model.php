<?php

require "conexion.php";

class ModelProductos {





	 static public function mdlMostrarUltimos4Prod($tabla) {


		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla order by fecha desc limit 4");
		$sql -> execute();
		return $sql->fetchAll();



	}

	static public function mdlMostrarCategorias($tabla,$columna,$valor) {

		if ($columna!=null){
		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE $columna = '$valor'");
		$sql -> execute();
		return $sql->fetch();

		}
		else {
		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();

		}

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();

	}

	static public function mdlMostrarSubCategorias($tabla, $columna,$valor){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE $columna = $valor");
		$sql -> execute();
		return $sql->fetchAll();
	}

	static public function mdlMostrarBaner($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla order by orden");
		$sql -> execute();
		return $sql->fetchAll();


	}
	static public function mdlMostrarInfoInicio($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();


	}
	static public function mdlMostrarInfoVision($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_fundacion=1");
		$sql -> execute();
		return $sql->fetchAll();


	}
	static public function mdlMostrarInfoMision($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_fundacion=2");
		$sql -> execute();
		return $sql->fetchAll();


	}
	static public function mdlMostrarInfoHacemos($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_fundacion=3");
		$sql -> execute();
		return $sql->fetchAll();


	}
	static public function mdlMostrarInfoPorque($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_victimas=1");
		$sql -> execute();
		return $sql->fetchAll();


	}
	static public function mdlMostrarInfoQue($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_victimas=2");
		$sql -> execute();
		return $sql->fetchAll();


	}
	static public function mdlMostrarInfoPrevencion($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_delitos=1");
		$sql -> execute();
		return $sql->fetchAll();


	}
	static public function mdlMostrarInfoPersecucion($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_delitos=2");
		$sql -> execute();
		return $sql->fetchAll();


	}
	static public function mdlMostrarInfoEstudios($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();


	}
		static public function mdlMostrarDirectorio($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();


	}
		static public function mdlMostrarOrganigrama($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();


	}
			static public function mdlMostrarProyectos($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();


	}
		static public function mdlMostrarDetallesProyectos($tabla,$valor){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_proyectos = $valor");
		$sql -> execute();
		return $sql->fetchAll();
	}
				static public function mdlMostrarBlog($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();


	}
		static public function mdlMostrarDetallesBlog($tabla,$valor){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_blog = $valor");
		$sql -> execute();
		return $sql->fetchAll();
	}
	static public function mdlMostrarHacemos($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();


	}
		static public function mdlMostrarRepre($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();


	}

			static public function mdlMostrarPublicaciones($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");
		$sql -> execute();
		return $sql->fetchAll();


	}
		static public function mdlMostrarDetallesPublicaciones($tabla,$valor){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE id_publicaciones = $valor");
		$sql -> execute();
		return $sql->fetchAll();
	}

	static public function mdlMostrarReparacion($tabla){

		$sql = Conexion::Conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql->fetchAll();


	}
}

?>
