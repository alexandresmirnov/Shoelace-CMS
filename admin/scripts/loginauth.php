<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}


$user = $_POST['user'];
$pass = $_POST['pass'];

$settings = simplexml_load_file('../../data/settings.xml');
$correctUser = $settings->user;
$correctPass = $settings->pass;

/* echo $correctUser." and ".$correctPass; */

if($user==$correctUser && $pass==$correctPass){
	$_SESSION["login"] = true; 
	//echo "Correct info";
	
	header('location: ../listposts.php');
}
else {
	$_SESSION["login"] = false; 
	//echo "Wrong info";
	
	header('location: ../index.php?action=error');
}





?>