<?php

require_once "conexion.php";

Class ModeloProyectos {

	static public function listarProyectosMdl($tabla) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql -> fetchAll();

	}

	static public function mdlCrearProyectos($tabla, $datos, $rutaImagen) {

		$sql = Conexion::conectar()->prepare("INSERT INTO $tabla() VALUES (NULL, :titulo,:subtitulo, :descripcion, :imagen)");
		$sql->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$sql->bindParam(":subtitulo", $datos["subtitulo"], PDO::PARAM_STR);
		$sql->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$sql->bindParam(":imagen", $rutaImagen, PDO::PARAM_STR);

		if( $sql -> execute() ) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEliminarProyectos($tabla, $id_proyectos) {

		$sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_proyectos = :id");

		$sql->bindParam(":id", $id_proyectos, PDO::PARAM_INT);

		if( $sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEditarProyectos($tabla, $id_proyectos) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_proyectos = :id");
		$sql->bindParam(":id", $id_proyectos, PDO::PARAM_INT);

		$sql -> execute();
		return $sql -> fetch();

	}

	static public function mdlActualizarProyectos($tabla, $datos, $rutaImagen) {

		if( is_null($rutaImagen)) {
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo,subtitulo = :subtitulo, descripcion = :descripcion WHERE id_proyectos = :id");

			$sql->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
			$sql->bindParam(":subtitulo", $datos["subtitulo"], PDO::PARAM_STR);
			$sql->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$sql->bindParam(":id", $datos["id_proyectos"], PDO::PARAM_INT);

		} else {
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo,subtitulo = :subtitulo, descripcion = :descripcion, rutaImg = :rutaNueva WHERE id_proyectos = :id");

			$sql->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
			$sql->bindParam(":subtitulo", $datos["subtitulo"], PDO::PARAM_STR);
			$sql->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$sql->bindParam(":rutaNueva", $rutaImagen, PDO::PARAM_STR);
			$sql->bindParam(":id", $datos["id_proyectos"], PDO::PARAM_INT);



		}

		if($sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

}


?>