<?php

session_start();
require_once('Output.php');
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
session_destroy();

if(!empty($old_user)){
	do_html_header('Logout');
		
	display_cerrar_sesion();
	
	do_html_footer();
}


?>