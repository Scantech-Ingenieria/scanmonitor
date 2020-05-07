<?php

require_once "../controllers/usuarios.controller.php";
require_once "../models/usuario.modelo.php";

Class ajaxUsuario {

	public $id_usuarios;
	public $nombre_usuarios;
	public $correo_usuarios;
	public $pass_usuarios;
	public $imagen_usuarios;
	public $rutaActual;

	public function crearUsuarios(){
        $datos = array("nombre"=>$this->nombre_usuarios,
                        "correo"=>$this->correo_usuarios,
						"pass"=>$this->pass_usuarios,
						"tipousuario"=>$this->tipousuario,
						"imagen"=>$this->imagen_usuarios);

		$respuesta = ControllerUsuarios::ctrCrearUsuarios($datos);

		echo $respuesta;
	}
	public function editarUsuarios(){
		$id_usuarios = $this->id_usuarios;

		$respuesta = ControllerUsuarios::ctrEditarUsuarios($id_usuarios);

		$datos = array("id_admin"=>$respuesta["id_admin"],
						"nombre_usuarios"=>$respuesta["nombre_admin"],
						"correo_admin"=>$respuesta["correo_admin"],
						"password"=>$respuesta["password_admin"],
						"rango"=>$respuesta["rango"],

						"imagen"=>substr($respuesta["avatar_admin"], 3)
						);

		echo json_encode($datos);

	}
	public function actualizarUsuarios(){
		$datos = array( "id_usuarios"=>$this->id_usuarios,
						"nombre_usuarios"=>$this->nombre_usuarios,
						"correo"=>$this->correo,
						"pass_usuarios"=>$this->pass_usuarios,
						"tipousuario"=>$this->tipousuario,						
						"imagen"=>$this->imagen,
						"rutaActual"=>$this->rutaActual
						);

		$respuesta = ControllerUsuarios::ctrActualizarUsuarios($datos);

		echo $respuesta;
	}
	public function eliminarUsuarios(){
		$id_usuarios = $this->id_usuarios;
		$ruta = $this->imagen_usuarios;

		$respuesta = ControllerUsuarios::ctrEliminarUsuarios($id_usuarios, $ruta);

		echo $respuesta;

	}


}

$tipoOperacion = $_POST["tipoOperacion"];

if($tipoOperacion == "insertarUsuarios") {
	$crearNuevoUsuarios = new ajaxUsuario();
    $crearNuevoUsuarios -> nombre_usuarios = $_POST["tituloUsuarios"];
    $crearNuevoUsuarios -> correo_usuarios = $_POST["correoUsuarios"];
	$crearNuevoUsuarios -> pass_usuarios = $_POST["passUsuarios"];
	$crearNuevoUsuarios -> tipousuario = $_POST["TipoUsuario"];
	$crearNuevoUsuarios -> imagen_usuarios = $_FILES["imagenUsuarios"];
	$crearNuevoUsuarios -> crearUsuarios();
}

if ($tipoOperacion == "editarUsuarios") {
	$editarUsuarios = new ajaxUsuario();
	$editarUsuarios -> id_usuarios = $_POST["id_Usuarios"];
	$editarUsuarios -> editarUsuarios();
}
if ($tipoOperacion == "actualizarUsuarios") {
	$actualizarUsuarios = new ajaxUsuario();
	$actualizarUsuarios -> id_usuarios = $_POST["id_Usuarios"];
	$actualizarUsuarios -> nombre_usuarios = $_POST["tituloUsuarios"];
	$actualizarUsuarios -> correo = $_POST["correo"];
	$actualizarUsuarios -> pass_usuarios = $_POST["urlUsuarios"];
	$actualizarUsuarios -> tipousuario = $_POST["TipoUsuario"];
	
	$actualizarUsuarios -> imagen = $_FILES["imagenUsuarios"];
	$actualizarUsuarios -> rutaActual = $_POST["rutaActual"];
	$actualizarUsuarios -> actualizarUsuarios();
}
if ($tipoOperacion == "eliminarUsuarios") {
	$eliminarUsuarios = new ajaxUsuario();
	$eliminarUsuarios -> id_usuarios = $_POST["id_Usuarios"];
	$eliminarUsuarios -> imagen_usuarios = $_POST["rutaImagen"];
	$eliminarUsuarios -> eliminarUsuarios();
}

?>