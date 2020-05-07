<?php

require_once "conexion.php";

Class ModeloSlider {

	static public function listarSliderMdl($tabla) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY orden ASC");
		$sql -> execute();
		return $sql -> fetchAll();

	}

	static public function mdlCrearSlider($tabla, $datos, $rutaImagen) {

		$sql = Conexion::conectar()->prepare("INSERT INTO $tabla() VALUES (NULL,:imagen,:titulo,:extension,:tiempo,NULL, NOW())");
	
		$sql->bindParam(":imagen", $rutaImagen, PDO::PARAM_STR);
		$sql->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);

		$sql->bindParam(":extension",$datos["extension"], PDO::PARAM_STR);
		$sql->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
	


		if( $sql -> execute() ) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEliminarSlider($tabla, $id_slider) {

		$sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$sql->bindParam(":id", $id_slider, PDO::PARAM_INT);

		if( $sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEditarSlider($tabla, $id_slider) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
		$sql->bindParam(":id", $id_slider, PDO::PARAM_INT);

		$sql -> execute();
		return $sql -> fetch();

	}

	static public function mdlActualizarSlider($tabla, $datos, $rutaImagen) {

		if( is_null($rutaImagen)) {
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET   fecha = NOW() WHERE id = :id");

		
			$sql->bindParam(":id", $datos["id_slider"], PDO::PARAM_INT);

		} else {
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET  rutaImg = :rutaNueva, fecha = NOW() WHERE id = :id");


		
			$sql->bindParam(":rutaNueva", $rutaImagen, PDO::PARAM_STR);
			$sql->bindParam(":id", $datos["id_slider"], PDO::PARAM_INT);



		}

		if($sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

}


?>