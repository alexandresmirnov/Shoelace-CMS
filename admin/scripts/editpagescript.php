<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}



$title = $_POST['title'];
$content = $_POST['content'];
$pageid = $_POST['pageid'];
$slug = $_POST['slug'];
$pageTemplate = $_POST['template'];

$pages = simplexml_load_file('../../data/pages.xml');


$toEdit=$pages->xpath("//page[contains(slug, '$slug')]");

$toEdit[0][0]->title = $title;
$toEdit[0][0]->content = stripslashes($content);
$toEdit[0][0]->slug = $slug;
$toEdit[0][0]->template = $pageTemplate = $_POST['template'];



//echo $posts->asXML();

$myFile = '../../data/pages.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $pages->asXML());
fclose($fh);

header('location: ../edit.php?page='.$slug.'&action=saved');

?>