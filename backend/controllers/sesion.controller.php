<?php 


Class ControllerSesion {

	public function iniciarSesionCtr() {

		if (isset($_POST["user"])) {
			$tabla = "administrador";
			$usuario = $_POST["user"];

			$respuesta = ModeloSesion::iniciarSesionMdl($tabla, $usuario);
			
			if($respuesta["correo_admin"] == $_POST["user"] && $respuesta["password_admin"] == $_POST["password"]) {

				$_SESSION["autenticar"] = "ok";
				$_SESSION["nombre"] = $respuesta["nombre_admin"];
				$_SESSION["id"] = $respuesta["id_admin"];
				$_SESSION["avatar"] = $respuesta["avatar_admin"];

				echo '
					<script>
						window.location = "home"
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