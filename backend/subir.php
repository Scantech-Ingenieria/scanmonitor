<?php 

$localtime = localtime();


list($ancho, $alto) = getimagesize($_FILES['archivo']["tmp_name"]);
		$nuevoAncho = 1024;
		$nuevoAlto = 768;
		$directorio = "views/dist/img/slider";
		if($_FILES['archivo']["type"] == "image/jpeg"){
			$rutaImagen = $directorio."/".md5($_FILES['archivo']["name"])."_".$localtime[0].".jpeg";
			$origen = imagecreatefromjpeg($_FILES['archivo']["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagejpeg($destino, $rutaImagen);
		}
         if($_FILES['archivo']["type"] == "image/png"){
			$rutaImagen = $directorio."/".md5($_FILES['archivo']["name"])."_".$localtime[0].".png";
			$origen = imagecreatefrompng($_FILES['archivo']["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagealphablending($destino, FALSE);
			imagesavealpha($destino, TRUE);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagepng($destino, $rutaImagen);

		}
		if($_FILES['archivo']["type"] == "video/mp4"){
	$rutaImagen = $directorio."/".md5($_FILES['archivo']["name"])."_".$localtime[0].".mp4";
	$tmp_datos=$_FILES['archivo']["tmp_name"];
				move_uploaded_file($tmp_datos, $rutaImagen);
		}

	

?>