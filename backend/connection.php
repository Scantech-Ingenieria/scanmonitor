<?php



	$DB_SERVER = "localhost";
	$DB_USERNAME = "sa";
	$DB_PASSWORD = "sa";
	$DB_DATABASE = "CL3500";

	// Array asociativo con la información de la conexion 
	$connectionInfo = array("UID"=>$DB_USERNAME, "PWD"=>$DB_PASSWORD, "Database"=>$DB_DATABASE);
	 
	// Nos conectamos mediante la autenticación de SQL Server
	$conn = sqlsrv_connect($DB_SERVER, $connectionInfo);
	

?>