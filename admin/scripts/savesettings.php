<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}

$postsPerPage = $_POST['postsPerPage'];
$siteName = $_POST['siteName'];
$theme = $_POST['theme'];
$user = $_POST['user'];
$pass = $_POST['pass'];

$settings = simplexml_load_file('../../data/settings.xml');

$settings->postsPerPage = $postsPerPage;
$settings->siteName = $siteName;
$settings->theme = $theme;
$settings->user = $user;
$settings->pass = $pass;




$myFile = '../../data/settings.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $settings->asXML());
fclose($fh);

header('location:'.$_SERVER['HTTP_REFERER']);

?>