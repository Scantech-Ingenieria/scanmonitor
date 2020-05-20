<?php

error_reporting(0);
require_once "controllers/template.controller.php";
require_once "controllers/enrutamiento.controller.php";

require_once "controllers/slider.controller.php";
require_once "controllers/usuarios.controller.php";
require_once "controllers/inicio.controller.php";


require_once "models/slider.modelo.php";
require_once "models/inicio.modelo.php";
require_once "models/usuario.modelo.php";


$template = new ControllerTemplate();
$template -> template();


?>