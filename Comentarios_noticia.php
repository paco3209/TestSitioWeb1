
<?php
include("config.php");
include("Output.php");

session_start();
$id_noticia = $_GET['id_not'];



$consulta_noticia = "SELECT * FROM Noticias where id_noticia = " . $id_noticia;

$consulta_comentarios = "SELECT * FROM comentarios where Id_Noticia = " . $id_noticia;

$r = mysql_query($consulta_noticia);

$d = mysql_query($consulta_comentarios);

if(mysql_num_rows($r)>0): //table is non-empty
	while($row = mysql_fetch_assoc($r)):

do_html_header($row['title']);

presentacion_navegador();

?>

<div class="grid_11" id="comentario_principal">
<div>
<?php

if (isset($_SESSION['valid_user'])){
?>
<span class='vote_buttons' id='vote_buttons<?php echo $row['id_noticia']; ?>'>  
 <a href='javascript:;' class='vote_up' id='<?php echo $row['id_noticia']; ?>'></a> 
  </span>
  <span class='vote_buttons' id='vote_buttons<?php echo $row['id_noticia']; ?>'>  
 <a href='javascript:;' class='vote_down' id='<?php echo $row['id_noticia']; ?>'></a> 
  </span>    
<?php
}
?>  
<a id="titulo_comentario" href='<?php echo $row['link']; ?>'> <?php echo $row['titulo']; ?> </a>

<p id="descripcion_comentario"> <?php echo $row['descripcion']; ?> </p>

<div class="grid_12">
<p class='votes_count' id='votes_count<?php echo $row['id_noticia']; ?>'><?php echo $row['votos']." votos"; ?></p>
</div>
<div class="clear"></div>
	

<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="" send="false" width="450" show_faces="true" font="arial"></fb:like>


</div>

<?php
	endwhile;
endif;
?>


<?php

if (isset($_SESSION['valid_user']))
{
?>

<hr>
<form method='post' action='Comentario_Ingresado.php?id=<?php echo $id_noticia; ?>' name="formulario">
<?php
include("Formulario_comentario.php");
}
?>
<hr>

<p>Comentarios:</p>

<?php

if(mysql_num_rows($d)>0): //table is non-empty
	while($row2 = mysql_fetch_assoc($d)):



?>

<div id="presentacion_comentario" >
<p id="usuario"><a href=""><?php echo $row2['id_usuario'] ;?></a></p> 
 <p id="descripcion_comentario"><?php 
 
 echo $row2['descripcion_comentario'] ; ?></p>
</div>
<div class="clear"></div>

<?php

endwhile;
endif;
?>

</div>

<?php
do_html_footer();
?>
