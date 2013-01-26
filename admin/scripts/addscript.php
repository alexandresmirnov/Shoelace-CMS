<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}


include_once('../objects.php');


if(isset($_POST['type'])){
	$type = $_POST['type'];

	if($type=='post'){
		$newEntry = new TypePost;
	}
	if($type=='page'){
		$newEntry = new TypePage;
	}
	if($type=='category'){
		$newEntry = new TypeCategory;
	}
	
	$newEntry->writeFields($newEntry->toSave, $newEntry->entryName, $newEntry->XMLfile);
		
}














?>