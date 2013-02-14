<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}


$settings = simplexml_load_file('../../data/settings.xml');


include_once('../objects.php');

if(isset($_POST['authKey'])){

$authKey = $_POST['authKey'];

if($authKey==$settings->authKey){


$postsPerPage = $_POST['postsPerPage'];
$siteName = $_POST['siteName'];
$theme = $_POST['theme'];
$installDir = $_POST['installDir'];
$user = $_POST['user'];
$pass = $_POST['pass'];

$settings->postsPerPage = $postsPerPage;
$settings->siteName = $siteName;
$settings->theme = $theme;
$settings->user = $user;
$settings->pass = $pass;
$settings->installDir = $installDir;




$myFile = '../../data/settings.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $settings->asXML());
fclose($fh);

}

}

header('location:'.$_SERVER['HTTP_REFERER']);

?>