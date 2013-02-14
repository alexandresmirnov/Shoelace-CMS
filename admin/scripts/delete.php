<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}

include_once "../objects.php";

$settings = simplexml_load_file('../../data/settings.xml');

$type = $_POST['type'];
$authKey = $_POST['authKey'];

if($authKey == $settings->authKey){


foreach($typeKeyValue as $key => $value){

	if($type==$key){
		
		$typeToDelete = new $value;
		echo $value;
		break;
		
	}

}



$fileBase = "../".$typeToDelete->whatFileBase;
echo $fileBase;
$file = simplexml_load_file($fileBase);


$toDelete = $_POST['toDelete'];
var_dump($toDelete);
	
	foreach($toDelete as $currentNodeID){
		echo $currentNodeID;
		$currentNode=$file->xpath($typeToDelete->XMLname."[@id=\"".$currentNodeID."\"]");
		echo "<br>";

		var_dump($currentNode);
		unset($currentNode[0][0]);
		
	}
	
	/*
    for($i=0; $i < $N; $i++)
    {
		$todelete=$posts->xpath('post[@id="'.$postsToDelete[$i].'"]');
		unset($todelete[0][0]);
    }
	*/


$fh = fopen($fileBase, 'w') or die("can't open file");
fwrite($fh, $file->asXML());
fclose($fh);

}

header('location:'.$_SERVER['HTTP_REFERER']);

?>