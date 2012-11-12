<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}

$posttodelete = $_POST['posttodelete'];

$posts = simplexml_load_file('../../data/posts.xml');


$todelete=$posts->xpath('post[@id="'.$posttodelete.'"]');
unset($todelete[0][0]);



$myFile = '../../data/posts.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $posts->asXML());
fclose($fh);

header('location:'.$_SERVER['HTTP_REFERER']);

?>