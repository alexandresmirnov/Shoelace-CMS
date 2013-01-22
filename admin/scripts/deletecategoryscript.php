<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}

$categories = simplexml_load_file('../../data/categories.xml');


$categoriesToDelete = $_POST['toDelete'];
$N = count($categoriesToDelete);
    echo("You deleted $N categories ");
    for($i=0; $i < $N; $i++)
    {
		$todelete=$categories->xpath('category[@id="'.$categoriesToDelete[$i].'"]');
		unset($todelete[0][0]);
    }




$myFile = '../../data/categories.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $categories->asXML());
fclose($fh);

header('location:'.$_SERVER['HTTP_REFERER']);

?>