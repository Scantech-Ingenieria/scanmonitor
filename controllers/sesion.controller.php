<?php 


Class ControllerSesion {

	public function iniciarSesionCtr() {

		if (isset($_POST["user"])) {
			$tabla = "administrador";
			$usuario = $_POST["user"];

			$respuesta = ModeloSesion::iniciarSesionMdl($tabla, $usuario);
			
			if($respuesta["correo_admin"] == $_POST["user"] && $respuesta["password_admin"] == $_POST["password"]) {

session_start();
				$_SESSION["autenticar"] = "ok";
				$_SESSION["nombre"] = $respuesta["nombre_admin"];
				$_SESSION["id"] = $respuesta["id_admin"];
				$_SESSION["avatar"] = $respuesta["avatar_admin"];
				$_SESSION["rango"] = $respuesta["rango"];


				echo '
					<script>
						window.location = "backend/slider"
					</script>
				';

			} else {
				echo '
					<div class="alert alert-danger">
						Datos incorrectos. Inténtelo nuevamente.
					</div>	
				';
			}
		}
	}
}

?>