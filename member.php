<?php
require_once('Output.php');

session_start();

$usuario = $_POST['username'];
$contrasena = $_POST['password'];

if ($usuario && $contrasena)
// they have just tried logging in
{
  try
  {
    login($usuario, $contrasena);
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $usuario;
  }
  catch(Exception $e)
  {
    // unsuccessful login
    do_html_header('Error:');
    echo '<div id="login_form">';
    echo '<p id="error">Debes estar registrado para poder ver esta pagina.</p>';
    
    echo '</div>';
    do_html_footer();
    exit;
  }      
}

do_html_header('Home');
check_valid_user();
// get the bookmarks this user has saved
/*echo '<a href="inicio.php">Ir a Pagina Principal</a>';
echo '</div>';
do_html_footer();*/
?>

