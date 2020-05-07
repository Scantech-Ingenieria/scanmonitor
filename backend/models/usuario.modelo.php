<?php

require_once "conexion.php";

Class ModeloUsuarios {

	static public function listarUsuariosMdl($tabla) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$sql -> execute();
		return $sql -> fetchAll();

	}

	static public function mdlCrearUsuarios($tabla, $datos, $rutaImagen) {

$nombre=$datos['nombre'];
$sqltabla="create table `$nombre` (
  `alumno_id` int(10) DEFAULT NULL,
  `nombres` varchar(80) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `f_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		$sql = Conexion::conectar()->prepare("INSERT INTO $tabla() VALUES (NULL, :nombre, :correo, :pass, :imagen,:tipousuario,  NOW())");

		$sql = Conexion::conectar()->prepare("$sqltabla");
        $sql->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $sql->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$sql->bindParam(":pass", $datos["pass"], PDO::PARAM_STR);
		$sql->bindParam(":tipousuario", $datos["tipousuario"], PDO::PARAM_STR);

		$sql->bindParam(":imagen", $rutaImagen, PDO::PARAM_STR);

		if( $sql -> execute() ) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEliminarUsuarios($tabla, $id_usuarios) {

		$sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_admin = :id");

		$sql->bindParam(":id", $id_usuarios, PDO::PARAM_INT);

		if( $sql->execute()) {
			return "ok";
		} else {
			return "error";
		}

	}

	static public function mdlEditarUsuarios($tabla, $id_usuarios) {

		$sql = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_admin = :id");
		$sql->bindParam(":id", $id_usuarios, PDO::PARAM_INT);

		$sql -> execute();
		return $sql -> fetch();

	}

	static public function mdlActualizarUsuarios($tabla, $datos, $rutaImagen) {

		if( is_null($rutaImagen)) {
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_admin = :nombre, correo_admin = :correo,password_admin = :pass_usuarios,rango =:tipousuario, fecha = NOW() WHERE id_admin = :id");

			$sql->bindParam(":nombre", $datos["nombre_usuarios"], PDO::PARAM_STR);
			$sql->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
			$sql->bindParam(":pass_usuarios", $datos["pass_usuarios"], PDO::PARAM_STR);
		$sql->bindParam(":tipousuario", $datos["tipousuario"], PDO::PARAM_STR);

			$sql->bindParam(":id", $datos["id_usuarios"], PDO::PARAM_INT);

		} else {
			$sql = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_admin = :nombre, correo_admin = :correo,password_admin = :pass_usuarios, avatar_admin = :rutaNueva,rango =:tipousuario, fecha = NOW() WHERE id_admin = :id");

			$sql->bindParam(":nombre", $datos["nombre_usuarios"], PDO::PARAM_STR);
			$sql->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
			$sql->bindParam(":pass_usuarios", $datos["pass_usuarios"], PDO::PARAM_STR);
		$sql->bindParam(":tipousuario", $datos["tipousuario"], PDO::PARAM_STR);

			$sql->bindParam(":rutaNueva", $rutaImagen, PDO::PARAM_STR);
			$sql->bindParam(":id", $datos["id_usuarios"], PDO::PARAM_INT);



		}

		if($sql->execute()) {
			return "ok";
		} else {
			return "error";


	}

}
}



?>