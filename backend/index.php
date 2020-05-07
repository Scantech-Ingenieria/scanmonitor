<?php
error_reporting(0);
require_once "controllers/template.controller.php";
require_once "controllers/enrutamiento.controller.php";
require_once "controllers/sesion.controller.php";
require_once "controllers/slider.controller.php";
require_once "controllers/categorias.controller.php";
require_once "controllers/subcategorias.controller.php";
require_once "controllers/usuarios.controller.php";
require_once "controllers/productos.controller.php";
require_once "controllers/inicio.controller.php";
require_once "controllers/fundacion.controller.php";
require_once "controllers/victimas.controller.php";
require_once "controllers/delitos.controller.php";
require_once "controllers/estudios.controller.php";
require_once "controllers/directorio.controller.php";
require_once "controllers/organigrama.controller.php";
require_once "controllers/representacion.controller.php";

require_once "controllers/proyectos.controller.php";
require_once "controllers/blog.controller.php";
require_once "controllers/hacemos.controller.php";
require_once "controllers/publicaciones.controller.php";
require_once "controllers/reparacion.controller.php";















require_once "models/sesion.modelo.php";


require_once "models/slider.modelo.php";
require_once "models/inicio.modelo.php";
require_once "models/fundacion.modelo.php";
require_once "controllers/victimas.controller.php";
require_once "models/victimas.modelo.php";
require_once "models/delitos.modelo.php";
require_once "models/estudios.modelo.php";
require_once "models/directorio.modelo.php";
require_once "models/organigrama.modelo.php";
require_once "models/proyectos.modelo.php";
require_once "models/blog.modelo.php";
require_once "models/hacemos.modelo.php";
require_once "models/representacion.modelo.php";
require_once "models/publicaciones.modelo.php";
require_once "models/reparacion.modelo.php";











require_once "models/categorias.modelo.php";
require_once "models/subcategorias.modelo.php";
require_once "models/usuario.modelo.php";
require_once "models/productos.modelo.php";

$template = new ControllerTemplate();
$template -> template();


?>