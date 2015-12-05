<?php
//pruebgitsisis

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

<!--Libreria Jquery validacion formulario -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="ValidacionFormulario.js" type="text/javascript" charset="utf-8"></script>

<script src="jquery-1.4.min.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.hoverIntent.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.scrollTo.js" type="text/javascript" charset="utf-8"></script> 
 <script type="text/javascript" src="script.js"></script>

 
<link href='http://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>    
</head>
  <body>
<div id="top">
<div class="container_12">

<div class="grid_12" id="logo">

   <a href="index.php"><img src="logo2.gif" alt="" width="120" height="45" ></a> 

<?php
if (isset($_SESSION['valid_user']))
{
	echo '<div id="login_div" class="grid_5">';
	echo '<p id="logueousuario"  class="' . $_SESSION['valid_user'] .'"" >Estas logueado como: '.$_SESSION['valid_user'];
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
</div>	<!-- grid_12 -->
<div class="clear"></div>  
   </div><!--container_12-->
   </div><!--top-->
   <div class="clear"></div>



  
   <div class="container_12" id="principal">
  



 <?php

}
function ir_al_cielo() {
?>
<a href="#" id="cielo">Ir al cielo </a>

<?php
}


function do_html_footer()
{
  // print an HTML footer
?>
	
	
	<div class="clear"></div>
<div id="footer_body">
<div class="container_12">	
	<p align="center" class="grid_12" id="footer">@2012 foob</p>

	</div>
<!-- START OF HIT COUNTER CODE -->
<br><script language="JavaScript" src="http://www.counter160.com/js.js?img=11"></script><br><a href="http://www.000webhost.com"><img src="http://www.counter160.com/images/11/left.png" alt="Free web hosting" border="0" align="texttop"></a><a href="http://www.hosting24.com"><img alt="Web hosting" src="http://www.counter160.com/images/11/right.png" border="0" align="texttop"></a>
<!-- END OF HIT COUNTER CODE -->
	
</div>
</div>
	 
  </body>
  </html>
<?php
}

function presentacion_noticias($consulta)
{
?>
<div class="grid_8" id="Principal">
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


$q = $consulta . " LiMIT $recordoffset, " . PERPAGE;
$c = "SELECT * FROM Noticias";
$r = mysql_query($q);
if(mysql_num_rows($r)>0): //table is non-empty
	while($row = mysql_fetch_assoc($r)):
		
				
		$net_vote = $row['votos']; //this is the net result of voting up and voting down
		
	
			
?>




<div id="noticia_individual">

<!--
<a href="index.php"><img src="grayarrow.gif" alt="" ></a>

Asi funciona
-->
<?php
	if (substr($row['link_noticia'],-3) == "jpg" || substr($row['link_noticia'],-3) == "gif") {
?>
<div id="imagen">
<img id="imagen_noticia" src="<?php echo $row['link_noticia']; ?>" alt="" >
</div>		

<div id="div_titulo_imagen">
<a id="titulo" href="<?php echo $row['link_noticia']; ?>"> <?php echo $row['titulo']; ?> </a><br>
</div>
<div id="div_link_imagen">
<a id="url" href="<?php echo $row['link_noticia']; ?>" >(<?php echo $row['link_noticia']; ?>)</a>
</div>


<?php
}
else {
?>
<div id="div_titulo">
<a id="titulo" href="<?php echo $row['link_noticia']; ?>"> <?php echo $row['titulo']; ?> </a><br>
</div>
<div id="div_link">
<a id="url" href="<?php echo $row['link_noticia']; ?>" >(<?php echo $row['link_noticia']; ?>)</a>
</div>
<?php
}
?>

<div id="resto_noticia">		
		<p id="fecha">Enviado hace
		<?php
		$fecha =  strtotime($row['Fecha']);
		echo tiempo_transcurrido($fecha) . " por " ; 
		?>
		<a href="" ><?php echo $row['id_usuario']; ?></a>
		</p>
<!--
<div id="imagen_categoria"><img src="<?php echo 'imagenesCategorias/'.$row['imagen_categoria']; ?>" id="imagen_noticia" alt="" ></div>				
						
		<p id="descripcion"> <?php echo $row['descripcion']; ?>
		</p>
		
-->	
<br>		
      	
	
	
	
	</div>


<div id="footer_noticia">	
<!--	<p class="votos"> <?php echo $row['votos'];?> Puntos |</p> -->
 
<p class="votos">Categoria: <?php echo $row['categoria']; ?> |</p>	
	
	
	
<p class="votos"><a id="comentario" href="Comentarios_noticia.php?id_not=<?php echo $row['id_noticia']; ?>" >Comentarios | </a></p>
 
 
<p class='votes_count' id='votes_count<?php echo $row['id_noticia']; ?>'><?php echo $row['votos']." votos | "; ?> </p>	
	

<?php

if (isset($_SESSION['valid_user']))
{
	$consulta_votos = "Select 1 from voto where id_noticia =" . $row['id_noticia'] . " and usuario ='" . $_SESSION['valid_user'] . "'";
	$f = mysql_query($consulta_votos);
	if(mysql_num_rows($f) == 0){
	
	
	
?>
<div>
<span class='vote_buttons' id='vote_buttons<?php echo $row['id_noticia']; ?>'>  
 <a href='javascript:;' class='vote_up' id='<?php echo $row['id_noticia']; ?>'>me gusta</a> 
  </span>  
<span class='vote_buttons' id='vote_buttons<?php echo $row['id_noticia']; ?>'>  
 <a href='javascript:;' class='vote_down' id='<?php echo $row['id_noticia']; ?>'>no me gusta</a> 
  </span>    
</div>
<?php
	}
}


?>

</div>

	
<div class="clear"></div>
	
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
</div>
<?php
}

function tiempo_transcurrido($ptime) {
$etime = time() - $ptime;

if ($etime < 1) {
    return '0 segundos';
}

$a = array( 12 * 30 * 24 * 60 * 60  =>  'a&ntildeo',
            30 * 24 * 60 * 60       =>  'mes',
            24 * 60 * 60            =>  'dia',
            60 * 60                 =>  'hora',
            60                      =>  'minuto',
            1                       =>  'segundo'
            );

foreach ($a as $secs => $str) {
    $d = $etime / $secs;
    if ($d >= 1) {
        $r = round($d);
        
        if($r > 1){
        	if($str == 'mes'){
        		return $r . ' ' . $str . 'es';
        	}
        	else{
        		return $r . ' ' . $str . 's';
        	}
         }
         else{
         	return $r . ' ' . $str. ' ';
         }
         
    }
}
}

function  presentacion_publicidad() {
	

?>

<div class="grid_1" id="publicidad">
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
<li><a href="index.php" class='active' >populares</a></li>
<!-- <li><a href="#">categorias</a>
<ul class="active">
Asi funciona el menu	
<li><a href="#"> Prueba</a></li>

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
</li>-->
<li><a href="ultimas_noticias.php">ultimas noticias</a></li>
</ul>
</div>
<div class="clear"></div>
<hr id="separador" class="grid_12"> 
<?php
}

function formulario_ingreso_noticia() {
	
?>



<div class="grid_12" id="entry">
<div id="formulario_ingreso_noticia">

<h1 id="nueva_noticia">Agregar Nueva Noticia</h1>


 <form method='post' action='Insertar.php' enctype="multipart/form-data">
 <table>
   <tr>
     <td><h2 id="titulo_nueva_noticia">Titulo Nueva Noticia</h2></td>
    </tr>
<tr> <td><input type='text' name='textbox_nueva_noticia' id="textbox_nueva_noticia" class="clear"></td></tr>   
<tr><td><h2 id="titulo_nueva_noticia">Link</h2></td></tr>
<tr> <td><input type='text' name='link_noticia' id="textbox_nueva_noticia" class="clear"></td></tr>
   

<tr><td><h2 id="titulo_nueva_noticia"> Categorias:</h2></td></tr>
   <tr>
   
   <td width="80%">
<select name="categorias">
<?php

$a = "select * from categoria";
$b = mysql_query($a);
if(mysql_num_rows($b)>0) {
	while($fila = mysql_fetch_assoc($b)) {
		?>
<option value="<?php echo $fila['descripcion']; ?> "> <?php echo $fila['descripcion']; ?> </option>			
		<?php
		}
	}
?> 
</select>   

    
</td>   
   </tr>
<tr><td><h2 id="titulo_nueva_noticia">Detalle</h2></td></tr>	
	<tr>

 
	<td><textarea name="descripcion" id="areas"></textarea>
	
	</td>

</tr>                     

   
   <tr>
   
     <td>
     <input type='submit' value='Ingresar' id="boton_ingreso">
     </td>
     
     
     </tr>
     
 </table></form>



</div>
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
  <form method='post' action='member.php' id="register-form" novalidate="novalidate">
  <table>
  
<tr><td> <label for="username"> <h2 id="titulo_nueva_noticia">Usuario:</h2></td></tr>
   <tr>
        <td><input type='text' name='username' id="login_usuario" class="clear"></td>
        </tr>
        <tr><td><h2 id="titulo_nueva_noticia">Password:</h2></td></tr>
        <tr>
          <td><input type='password' name='password'  id="login_Password" class="clear"></td>
        
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
<h1 id="nueva_noticia" align="center">Crear una nueva cuenta</h1>
<div id="formulario">  

    <form method='post' action='registro_confirmado.php'>
  
  <table>
<tr><td><h2 id="titulo_nueva_noticia">Usuario:</h2></td></tr>   
   <tr>
        <td><input type='text' name='username' id="login_usuario" class="clear"></td>
<tr><td><h2 id="titulo_nueva_noticia">Password:</h2></td></tr>
<tr>         
          <td><input type='password' name='password1' id="login_Password" class="clear"></td>
    </tr>
<tr><td><h2 id="titulo_nueva_noticia">Confirmacion de Password:</h2></td></tr>   
   <tr>         
          <td><input type='password' name='password2' id="login_Password" class="clear"></td>
    </tr>      
      <tr><td><h2 id="titulo_nueva_noticia">Mail:</h2></td></tr>
<tr>
<td><input type="text" name="mail"id="login_usuario" class="clear"></td>
</tr>    
          
        <td colspan=2 align='center'>
</tr>
<tr>     
     <td><input type='submit' value='Registrarme' id="boton_ingreso"></td>
</tr>   
   </table></form>
</div>   
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
	   /*echo '<div id="login_form">';
      echo 'Bienvenido '.$_SESSION['valid_user'].'.';
      */
      header('Location: index.php');
      exit();
  }
  else
  {
     // they are not logged in 
   
     echo 'El usuario o contrase&ntildea es erroneo.<br />';
     echo '<a href="login.php">Login</a>';
     do_html_footer();
     exit;
  }  
}

function display_cerrar_sesion () {
	
?>
	
<div id="comentarioOK" class="grid_12">
<div id="formulario">	
	<h1 align="center">Cerraste Sesion</h1>	
	<a href="index.php" id="VolverPaginaPrincipal">Pagina Principal</a>
</div>
</div>
<?php	
}

?>

