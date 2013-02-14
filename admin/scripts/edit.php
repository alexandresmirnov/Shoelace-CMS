<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}

$settings = simplexml_load_file('../../data/settings.xml');


include_once('../objects.php');

if(isset($_POST['authKey']) && isset($_POST['type'])){

$authKey = $_POST['authKey'];

if($authKey==$settings->authKey){


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
	
	$newEntry->editFields($newEntry->toSave, $newEntry->entryName, $newEntry->XMLfile);
	
	//echo $newEntry->slug;
	
	//header('Location: ');
	
}

}


?>