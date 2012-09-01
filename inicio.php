<?php



session_start();
require_once('Output.php');


do_html_header('Prueba');

presentacion_navegador();
link_nuevo_registro();
presentacion_noticias("SELECT * FROM Noticias order by Votos desc");
presentacion_publicidad();
ir_al_cielo();

do_html_footer();

?>