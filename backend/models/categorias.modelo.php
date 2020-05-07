<?php 

require_once "conexion.php";

Class ModeloCategorias {

	static public function listarCategoriasMdl($tabla) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql -> fetchAll();

	}

	static public function mdlCrearCategorias($tabla, $datos) {

		$sql = Conexion::conectar()->prepare("INSERT INTO $tabla() VALUES (NULL, :categoria, :ruta,   NOW())");
		$sql->bindParam(":categoria", $datos["titulo"], PDO::PARAM_STR);
		$sql->bindParam(":ruta", $datos["vinculo"], PDO::PARAM_STR);

		if( $sql -> execute() ) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEliminarCategorias($tabla, $id_categorias) {

		$sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$sql->bindParam(":id", $id_categorias, PDO::PARAM_INT);

		if( $sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEditarCategorias($tabla, $id_categorias) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
		$sql->bindParam(":id", $id_categorias, PDO::PARAM_INT);

		$sql -> execute();
		return $sql -> fetch();

	}

	static public function mdlActualizarCategorias($tabla, $datos) {

	
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :titulo,  ruta = :vinculo, fecha = NOW() WHERE id = :id");

			$sql->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
			$sql->bindParam(":vinculo", $datos["vinculo"], PDO::PARAM_STR);
			$sql->bindParam(":id", $datos["id_categorias"], PDO::PARAM_INT);

		

		if($sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

}


?>