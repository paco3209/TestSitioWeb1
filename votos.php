<?php

require_once('config.php');
require_once('conexion_db.php');




$id = $_POST['id'];
$action = $_POST['action'];



function Obtener_votos($id) {
	
	$q= "select * from Noticias where id_noticia = $id";
	$r= mysql_query($q);
	
		$row = mysql_fetch_assoc($r);
		$votos = $row['votos'];
	
		return $votos;
}


// Falta calculo de votos. Ver algoritmo


function getEffectiveVotes($id)  
 {  

 
   
 $votes = Obtener_votos($id);  
 $effectiveVote = $votes;  
 return $effectiveVote;  
 } 

 


//get the current votes
$cur_votes = Obtener_votos($id);

//ok, now update the votes

if($action == 'vote_up')
{






 $votes_up = $cur_votes[0]+1;
 $q = "UPDATE Noticias SET votos = $votes_up WHERE id_noticia = $id";
$r = mysql_query($q);



if($r) //voting done
 {
 $effectiveVote = getEffectiveVotes($id);
 echo $effectiveVote." votos";
 }
elseif(!$r) //voting failed
 {
 echo "Failed!";
 }
} 
 
if($action == 'vote_down')
{
 $votes_down = $cur_votes[0]-1;
 $q = "UPDATE Noticias SET votos = $votes_down WHERE id_noticia = $id";
$r = mysql_query($q);



if($r) //voting done
 {
 $effectiveVote = getEffectiveVotes($id);
 echo $effectiveVote." votos";
 }
elseif(!$r) //voting failed
 {
 echo "Failed!";
 }
} 
  
 

	?>