<?php



session_start();
require_once('Output.php');


do_html_header('Prueba');

presentacion_navegador();
link_nuevo_registro();
presentacion_noticias("SELECT id_noticia, id_usuario, Noticias.descripcion, Fecha, votos, titulo, link_noticia, categoria, imagen_categoria FROM Noticias, categoria where Noticias.Categoria = categoria.descripcion order by Votos desc");
presentacion_publicidad();
ir_al_cielo();

do_html_footer();

?>