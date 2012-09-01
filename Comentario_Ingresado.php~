<?php


include("config.php");
include("Output.php");
session_start();
$id_noti = $_GET['id'];
$descripcion = $_POST['desc'];



$q = "insert into comentarios(`Id_Noticia` ,`descripcion_comentario` ,`Id_Usuario` ,`Fecha`) VALUES (" . $id_noti . ",'" . $descripcion . "','" . $_SESSION['valid_user'] ."',01-04-2011)";

$r = mysql_query($q);

do_html_header("Registro ingresado");
?>




<body>
<?php

if(!$r) {
	echo "El registro no pudo ser ingresado";
	}
else
	{
?>


<div id="comentarioOK" class="grid_12">
<div id="formulario">
<h1>Comentario Ingresado ;)</h1>

<a href='Comentarios_noticia.php?id_not=<?php echo $id_noti; ?>' id="volverNoticia" >Volver a noticia</a>
</div>  
</div>

<?php
}
do_html_footer();
	
?>

