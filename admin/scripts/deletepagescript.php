<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}

$pages = simplexml_load_file('../../data/pages.xml');


$pagesToDelete = $_POST['toDelete'];

print_r($pagesToDelete);

$N = count($pagesToDelete);
    for($i=0; $i < $N; $i++)
    {
		$todelete=$pages->xpath('page[@id="'.$pagesToDelete[$i].'"]');
		unset($todelete[0][0]);
    }




$myFile = '../../data/pages.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $pages->asXML());
fclose($fh);

header('location:'.$_SERVER['HTTP_REFERER']);

?>