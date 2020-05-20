<?php
require_once "db.php";
$array_cursos = $_POST['miorden'];

$con = con();

$orden = 2;
foreach($array_cursos as $id_curso){
	$resultado_cursos = "UPDATE slider SET orden = $orden WHERE id = $id_curso";
	$resultado_cursos = mysqli_query( $con,$resultado_cursos);	
	$orden++;
}
echo "<h3 style='margin-left:300px;'><span style='color: green;'>La lista ha sido cambiada.</span></h3>";