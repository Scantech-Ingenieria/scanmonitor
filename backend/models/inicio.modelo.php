<?php

require_once "conexion.php";

Class ModeloInicio {

	static public function listarInicioMdl($tabla) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql -> fetchAll();

	}



	static public function mdlEditarInicio($tabla, $id_inicio) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_info = :id");
		$sql->bindParam(":id", $id_inicio, PDO::PARAM_INT);

		$sql -> execute();
		return $sql -> fetch();

	}

	static public function mdlActualizarInicio($tabla, $datos) {

			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET informacion = :info WHERE id_info = :id");

			$sql->bindParam(":info", $datos["informacion"], PDO::PARAM_STR);
			$sql->bindParam(":id", $datos["id_info"], PDO::PARAM_INT);


		if($sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

}


?>