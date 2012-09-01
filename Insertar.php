<?php


include("config.php");
session_start();


$titulo = $_POST['textbox_nueva_noticia'];
$descripcion = $_POST['descripcion'];
$link_noticia = $_POST['link_noticia'];
$categoria = $_POST['categorias'];
$usuario = $_SESSION['valid_user'];

?>





<html>
<head>
	<title>Votes</title>
	
<style type='text/css'>
body {
	background: #e8e6de;
</style>


</head>
<body>



<?php

$dia = date('c');

$q = "insert into Noticias(titulo,descripcion, Fecha, categoria, link_noticia,id_usuario) values('" . $titulo . "','" . $descripcion . "', '" . $dia .  "','"  . $categoria . "','" . $link_noticia . "','" . $usuario .  "')";
$r = mysql_query($q);

if(!$r) {
	echo "El registro no pudo ser ingresado";
	}	
else
	{
	echo "Registro Ingresado Correctamente</br>";
	echo "<a href=inicio.php>Inicio</a>";
}	
?>


</body>
</html>

