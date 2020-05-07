<?php
/*CONTROLADORES*/
require_once "controllers/enrutamiento.controller.php";
require_once "controllers/template.controller.php";

require_once "controllers/productos.controller.php";

/*MODELO*/
require_once "models/productos.model.php";
require_once "models/rutas.php";

//error_reporting(0);

$template = new ControllerTemplate();
$template -> template();

?>