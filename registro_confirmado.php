<?php

$usuario = $_POST['username'];
$pass1 = $_POST['password1'];
$pass2 = $_POST['password2'];
$mail = $_POST['mail'];

mail($mail,"Prueba","mensaje");

include('config.php');
include('Output.php');

if ($usuario & $pass1 & $pass2 & $mail) {

if($pass1 != $pass2) {
	header('Location: register_form.php');
}
else {
	$q = "select * from usuarios where nombre ='" . $usuario . "'";
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0) {
		header('Location: register_form.php');
}		
	else {
		$i = "insert into usuarios(mail,nombre,password) values ('" . $mail . "','" . $usuario . "',sha1('" . $pass1 . "'))";
		$r= mysql_query($i);		
		do_html_header('Registro Ingresado');		
?>		
<div id="comentarioOK" class="grid_12">
<div id="formulario">
<h1 align="center">Registro Ingresado ;)</h1>

<a href='index.php' id="volverNoticia" >Ir a Portada</a>
</div>  
</div>

<?php
		do_html_footer();		
		} 
}
	}

?>