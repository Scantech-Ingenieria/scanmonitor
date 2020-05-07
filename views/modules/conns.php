<?php

	//$serverName = "DMCA-SERVER\sqlexpress"; //serverName\instanceName
	//$serverName = "serverName\sqlexpress, 1542"; //serverName\instanceName, portNumber (por defecto es 1433)

	// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
	// La conexión se intentará utilizando la autenticación Windows.
	//$connectionInfo = array( "Database"=>"CL3500");
	//$conn = sqlsrv_connect( "192.168.2.30", $connectionInfo);




	// Parametrizacíón
	// $DB_SERVER = "DMCA-SERVICIOS\SQLEXPRESS";	
	// $DB_DATABASE = "PROPACK";
	// $DB_USERNAME = "sa";
	// $DB_PASSWORD = "123456";

	$DB_SERVER = "localhost";
	$DB_USERNAME = "sa";
	$DB_PASSWORD = "sa";
	$DB_DATABASE = "CL3500";

	// Array asociativo con la información de la conexion 
	$connectionInfo = array("UID"=>$DB_USERNAME, "PWD"=>$DB_PASSWORD, "Database"=>$DB_DATABASE);
	 
	// Nos conectamos mediante la autenticación de SQL Server
	$conn = sqlsrv_connect($DB_SERVER, $connectionInfo);
	
	// Verificación de conexión con base de datos.
	if( $conn ) {
    	//echo "Conexión establecida.<br />";
    	$_SESSION["logged"] = "true";
	}else{
    	echo "Conexión no se pudo establecer.<br />";
    	die( print_r( sqlsrv_errors(), true));
	}
?>