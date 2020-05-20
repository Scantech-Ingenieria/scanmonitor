<?php
require_once "conexion.php";
Class ModeloSlider {
	static public function listarSliderMdl($tabla) {
		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla where extension !='primero' ORDER BY orden ASC");
		$sql -> execute();
		return $sql -> fetchAll();
	}
		static public function listarPesajeMdl($tabla) {
		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql -> fetchAll();
	}
	static public function mdlCrearSlider($tabla, $datos, $rutaImagen) {
	$sqle = Conexion::conectar()->prepare("SELECT * FROM $tabla order by orden desc limit 1");
$sqle -> execute() ;
foreach ($sqle as $key => $value){
    $orden=$value["orden"];
}
$ordennuevo = $orden + 1;
		$sql = Conexion::conectar()->prepare("INSERT INTO $tabla() VALUES (NULL,:imagen,:titulo,:excel,:extension,:tiempo,$ordennuevo, NOW())");
		$sql->bindParam(":imagen", $rutaImagen, PDO::PARAM_STR);
		$sql->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$sql->bindParam(":extension",$datos["extension"], PDO::PARAM_STR);
		$sql->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
		$sql->bindParam(":excel", $datos["excel"], PDO::PARAM_STR);

		if( $sql -> execute() ) {
			return "ok";
		} else {
			return "error";
		}
	}
		static public function mdlCrearPesaje($tabla, $datos) {
	
	$sqle = Conexion::conectar()->prepare("SELECT * FROM $tabla");
    $sqle -> execute();
              
foreach ($sqle as $key => $value){
    $id=$value["id_pesaje"];
}  
if ($value["id_pesaje"]!='') {
		$sqlee = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_pesaje = $id");
        $sqlee -> execute();
        
	$sql = Conexion::conectar()->prepare("INSERT INTO $tabla() VALUES (NULL,:contratista,:fecha,:brazo1,:brazo2,:brazo3,:brazo4,:first,:ponto)");

		$sql->bindParam(":contratista", $datos["contratista"], PDO::PARAM_STR);
		$sql->bindParam(":fecha",$datos["fecha"], PDO::PARAM_STR);
		$sql->bindParam(":brazo1", $datos["brazo1"], PDO::PARAM_STR);
		$sql->bindParam(":brazo2", $datos["brazo2"], PDO::PARAM_STR);
		$sql->bindParam(":brazo3", $datos["brazo3"], PDO::PARAM_STR);
		$sql->bindParam(":brazo4", $datos["brazo4"], PDO::PARAM_STR);
		$sql->bindParam(":first", $datos["first"], PDO::PARAM_STR);
		$sql->bindParam(":ponto", $datos["ponto"], PDO::PARAM_STR);
	
			if( $sql -> execute() ) {
			return "ok";
		} else {
			return "error";
		}
                }
		$sql = Conexion::conectar()->prepare("INSERT INTO $tabla() VALUES (NULL,:contratista,:fecha,:brazo1,:brazo2,:brazo3,:brazo4,:first,:ponto)");

		$sql->bindParam(":contratista", $datos["contratista"], PDO::PARAM_STR);
		$sql->bindParam(":fecha",$datos["fecha"], PDO::PARAM_STR);
		$sql->bindParam(":brazo1", $datos["brazo1"], PDO::PARAM_STR);
		$sql->bindParam(":brazo2", $datos["brazo2"], PDO::PARAM_STR);
		$sql->bindParam(":brazo3", $datos["brazo3"], PDO::PARAM_STR);
		$sql->bindParam(":brazo4", $datos["brazo4"], PDO::PARAM_STR);
		$sql->bindParam(":first", $datos["first"], PDO::PARAM_STR);
		$sql->bindParam(":ponto", $datos["ponto"], PDO::PARAM_STR);

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
	static public function mdlActualizarSlider($tabla, $datos) {

	
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo,tiempo =:segundos WHERE id = :id");

		
			$sql->bindParam(":id", $datos["id_slider"], PDO::PARAM_INT);
			$sql->bindParam(":segundos", $datos["segundos"], PDO::PARAM_INT);
			$sql->bindParam(":titulo", $datos["titulo"], PDO::PARAM_INT);



		if($sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

}


?>