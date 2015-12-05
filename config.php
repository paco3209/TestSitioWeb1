<?php
$hostname = "localhost";
$db_username = "root";
$db_password = "frano4240";

$link = mysql_connect($hostname, $db_username, $db_password) or die("Cannot connect to the database");
mysql_select_db("fml") or die("Cannot select the database");


?>