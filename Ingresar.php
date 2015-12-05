<?php


session_start();
require_once('Output.php');

if (isset($_SESSION['valid_user']))
{


do_html_header('Ingresar Noticia');


formulario_ingreso_noticia();

do_html_footer();
}
else {
	do_html_header('Error');
	echo '<div id="login_form">';	
	echo '<p id="error">Debes estar registrado para poder ingresar una noticia.</p>';
	echo '</div>';
	echo '</div>'; 
	do_html_footer();
}
?>
