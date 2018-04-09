<?php 
session_start();



$contenido=json_encode($_SESSION);
$onlyconsonants=$_SESSION['email'];
$nombreUsuario = str_replace(".", "", $onlyconsonants);
$ext=".json";
$nombreArchivoUsuario=$nombreUsuario.$ext;

var_dump($_SESSION);
echo "<br>";

$verificarchivoexist = $nombreArchivoUsuario;
if (file_exists($verificarchivoexist)) {
	$lectura=file_get_contents($verificarchivoexist);
	$mostrarJson = json_decode($lectura,true);
	foreach ($mostrarJson as $campo => $dato) {
		if($_SESSION[$campo]){
			$mostrarJson[$campo]=$_SESSION[$campo];
			$fh = fopen($verificarchivoexist, 'w');
      fwrite($fh, json_encode($mostrarJson,JSON_UNESCAPED_UNICODE));
fclose($fh);
		}
	}

header("Location:../index.php");

		
		
}


?>