<?php 

require_once "conexion.php";

Class ModelosubCategorias {

	static public function listarsubCategoriasMdl($tabla) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql -> fetchAll();

	}

	static public function mdlCrearsubCategorias($tabla, $datos, $rutaImagen) {

		$sql = Conexion::conectar()->prepare("INSERT INTO $tabla() VALUES (NULL, :subcategoria, :ruta, :imagen,  NOW(),1)");
		$sql->bindParam(":subcategoria", $datos["titulo"], PDO::PARAM_STR);
		$sql->bindParam(":ruta", $datos["vinculo"], PDO::PARAM_STR);
		$sql->bindParam(":imagen", $rutaImagen, PDO::PARAM_STR);

		if( $sql -> execute() ) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEliminarsubCategorias($tabla, $id_subcategorias) {

		$sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$sql->bindParam(":id", $id_subcategorias, PDO::PARAM_INT);

		if( $sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEditarsubCategorias($tabla, $id_subcategorias) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
		$sql->bindParam(":id", $id_subcategorias, PDO::PARAM_INT);

		$sql -> execute();
		return $sql -> fetch();

	}

	static public function mdlActualizarsubCategorias($tabla, $datos, $rutaImagen) {

		if( is_null($rutaImagen)) {
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, descripcion = :descripcion, url = :vinculo, fecha = NOW() WHERE id = :id");

			$sql->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
			$sql->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$sql->bindParam(":vinculo", $datos["vinculo"], PDO::PARAM_STR);
			$sql->bindParam(":id", $datos["id_subcategorias"], PDO::PARAM_INT);

		} else {
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, descripcion = :descripcion, rutaImg = :rutaNueva, url = :vinculo, fecha = NOW() WHERE id = :id");

			$sql->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
			$sql->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$sql->bindParam(":rutaNueva", $rutaImagen, PDO::PARAM_STR);
			$sql->bindParam(":vinculo", $datos["vinculo"], PDO::PARAM_STR);
			$sql->bindParam(":id", $datos["id_subcategorias"], PDO::PARAM_INT);



		} 

		if($sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

}


?>