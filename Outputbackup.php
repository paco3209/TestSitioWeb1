<?php


require_once('PageNavigator.php');

require_once('config.php');
require_once('conexion_db.php');


function do_html_header($title)
{
  // print an HTML header
?>
  <html>
  <head>
    <title><?php echo $title;?></title>

<link rel="stylesheet" type="text/css" media="all" href="code/css/960.css" />
<link rel="stylesheet" type="text/css" media="all" href="960.css" />

<script src="jquery-1.4.min.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.hoverIntent.js" type="text/javascript" charset="utf-8"></script>
 <script type="text/javascript" src="script.js"></script>
</head>
  <body>
<div id="top">
<div class="container_12">

<div class="grid_12" id="logo">

   <a href="inicio.php"><img src="logo2.gif" alt="" width="120" height="70" ></a> 

<?php
if (isset($_SESSION['valid_user']))
{
	echo '<div id="login_div" class="grid_5">';
	echo '<p>Estas logueado como: '.$_SESSION['valid_user'];
	echo '<a href="cerrar_sesion.php" id="cerrar_sesion">Cerrar Sesion</a>';
	echo '</div>';

?>

<?php
}
else {

?>

<div id="login_div" class="grid_5">
<a href="login.php"  id="loginLink">Iniciar sesi&oacute;n</a>   
  </div>
 <?php
}
?>
</div>	
<div class="clear"></div>  
   </div><!--container_12-->
   </div><!--top-->
   <div class="clear"></div>



  
   <div class="container_12">
  



 <?php

}

function do_html_footer()
{
  // print an HTML footer
?>
	</div>
	<div class="clear"></div>
<div id="footer_body">
<div class="container_12">	
	<p align="center" class="grid_12" id="footer">@2011 foob</p>
	</div>
</div>

	 
  </body>
  </html>
<?php
}

function presentacion_noticias()
{
?>
<div class="grid_12" id="Principal">
<?php

define("PERPAGE", 10);
define("OFFSET", "offset");
//get query string
$offset=@$_GET[OFFSET];
//check variable
if (!isset($offset)){
	$recordoffset=0;
}else{
	//calc record offset
	$recordoffset=$offset*PERPAGE;
}


$q = "SELECT * FROM Noticias order by Fecha  LiMIT $recordoffset, " . PERPAGE;
$c = "SELECT * FROM Noticias order by Fecha";
$r = mysql_query($q);
if(mysql_num_rows($r)>0): //table is non-empty
	while($row = mysql_fetch_assoc($r)):
		
				
		$net_vote = $row['votos']; //this is the net result of voting up and voting down
		
	
			
?>




<div id="noticia_individual">
<a href="inicio.php"><img src="grayarrow.gif" alt="" ></a>
<a id="titulo" href="<?php echo $row['link_noticia']; ?>"> <?php echo $row['titulo']; ?> </a><br>
<a id="url" href="<?php echo $row['link_noticia']; ?>" >(<?php echo $row['link_noticia']; ?>)</a>
<div id="resto_noticia">		
		<p id="fecha">Enviado el: 
		<?php
		$fecha = date('d/m/Y', strtotime($row['Fecha']) ) ;
		echo $fecha ; 
		?>
		</p>
				
		<p id="descripcion"> <?php echo $row['descripcion']; ?></p>
<br>		
      	
	
	
	
	</div><br>
	<div id="footer_noticia">	
	<p class="votos"> <?php echo $row['votos'];?> Puntos |</p>
	<p class="votos">Categoria: <?php echo $row['categoria']; ?> |</p>
	
	<p class="votos"><a id="comentario" href="http://localhost/TestSitioWeb/Comentarios_noticia.php?id_not=<?php echo $row['id_noticia']; ?>" >Ver Comentarios </a></p>
	
	</div>
	<br>
</div>
<br>
<hr />
<?php

	endwhile;
endif;

$pagename=basename($_SERVER['PHP_SELF']);
//find total number of records
$prueba = mysql_query($c);

$totalrecords= mysql_num_rows($prueba);

$numpages = ceil($totalrecords/PERPAGE);
//create category parameter

//create if needed
if($numpages>1){
  //create navigator
  $nav = new PageNavigator($pagename, $totalrecords, PERPAGE,$recordoffset);
  echo $nav->getNavigator();
}
?>
</div>

<?php
}



function  presentacion_publicidad() {
	

?>

<div class="grid_2" id="publicidad">
<img src="imgad.jpeg" alt="" >
<img src="imgad.jpeg" alt="" >

</div>
<div class="clear"></div>

<?php
}

function presentacion_navegador() {

?>

<div class="grid_12" id="main-menu">
<ul id="menu">
<li><a class="active" href="inicio.php" >inicio</a></li>
<li><a href="#">categorias</a>
<ul class="active">
<!-- Asi funciona el menu
<li><a href="#"> Prueba</a></li>
-->
<?php
$a = "select * from categoria";
$b = mysql_query($a);
if(mysql_num_rows($b)>0) {
	while($fila = mysql_fetch_assoc($b)) {
		echo '<li><a href="inicio.php?cat=' . $fila['descripcion']. '">';
		
		 echo $fila['descripcion'];
		 echo "</a></li>";
		}
	}
?>
		
</ul>
</li>
<li><a href="#">ultimas noticias</a></li>
</ul>
</div>
<div class="clear"></div>
<hr id="separador" class="grid_12"> 
<?php
}

function formulario_ingreso_noticia() {
	
?>



<div class="grid_8" id="entry">
<hr id="separador">
<h1 id="nueva_noticia">Agregar Nueva Noticia</h1>


 <form method='post' action='Insertar.php' enctype="multipart/form-data">
 <table>
   <tr>
     <td><h2 id="titulo_nueva_noticia"></h2></td>
    </tr>
<tr> <td><input type='text' name='textbox_nueva_noticia' id="textbox_nueva_noticia" value="Titulo" class="clear"></td></tr>   

<tr> <td><input type='text' name='link_noticia' id="textbox_nueva_noticia" value="Link" class="clear"></td></tr>
   
   <tr><td>
<select name="categorias">
<option value="Tecnologia">Tecnologia</option>
<option value="Ocio">Ocio</option>
<option value="Cultura">Cultura</option>
<option value="Actualidad">Actualidad</option>
<option value="Humor">Humor</option>
</select>    
</td>   
   </tr>
	<tr>

 
	<td><textarea name="descripcion" id="areas">Detalle...</textarea>
	
	</td>

</tr>                     

   
   <tr>
   
     <td>
     <input type='submit' value='Ingresar' id="boton_ingreso">
     <input type='button' value='Limpiar' id="Limpiar_formulario">
     </td>
     
     
     </tr>
     
 </table></form>




</div>


<?php
}

function link_nuevo_registro() {

?>

<div class="grid_12">
<a href="Ingresar.php"  id="nuevo_registro" >Ingresar Nueva Noticia</a>
</div>
<?php
}

function display_login_form()
{
?>
<div id="login_form" class="grid_12" >  
<div id="formulario">  
  <a href='register_form.php' id="registrarme">Registrarme</a>
  <form method='post' action='member.php'>
  <table>
   <tr>
        <td><input type='text' name='username' value="Usuario" id="login_usuario" class="clear"></td>
          <td><input type='password' name='password'  value="password" id="login_Password" class="clear"></td>
        <td colspan=2 align='center'>
</tr>
<tr>     
     <td><input type='submit' value='Iniciar sesion' id="boton_ingreso"></td>
</tr>   
   </table></form>
</div>   
   </div>
<?php
}

function display_register_form()

{
?>
<div id="login_form" class="grid_12" >  
<div id="formulario">  
    <form method='post' action='registro_confirmado.php'>
  <table>
   <tr>
        <td><input type='text' name='username' value="Usuario" id="login_usuario" class="clear"></td>
<tr>         
          <td><input type='text' name='password1'  value="password1" id="login_Password" class="clear"></td>
    </tr>
   <tr>         
          <td><input type='text' name='password2'  value="password2" id="login_Password" class="clear"></td>
    </tr>      
      
<tr>
<td><input type="text" name="mail" value="eMail" id="login_usuario" class="clear"></td>
</tr>    
          
        <td colspan=2 align='center'>
</tr>
<tr>     
     <td><input type='submit' value='Registrarme' id="boton_ingreso"></td>
</tr>   
   </table></form>
</div>   
<?php
}



function login($username, $password)
// check username and password with db
// if yes, return true
// else throw exception
{
  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = $conn->query("select * from usuarios 
                         where nombre='$username'
                         and password = sha1('$password')");
  if (!$result)
     throw new Exception('Could not log you in.');
  
  if ($result->num_rows>0)
     return true;
  else 
     throw new Exception('Could not log you in.');
}

function check_valid_user()
// see if somebody is logged in and notify them if not
{
  if (isset($_SESSION['valid_user']))
  {
	   echo '<div id="login_form">';
      echo 'Bienvenido '.$_SESSION['valid_user'].'.';
      
  }
  else
  {
     // they are not logged in 
   
     echo 'You are not logged in.<br />';
     echo '<a href="login.php">Login</a>';
     do_html_footer();
     exit;
  }  
}



?>

