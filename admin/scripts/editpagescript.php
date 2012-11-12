<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}



$title = $_POST['title'];
$content = $_POST['content'];
$pageid = $_POST['pageid'];
$slug = $_POST['slug'];
$pageTemplate = $_POST['pageTemplate'];

$pages = simplexml_load_file('../../data/pages.xml');


$toEdit=$pages->xpath('page[@id="'.$pageid.'"]');

$toEdit[0][0]->title = $title;
$toEdit[0][0]->content = $content;
$toEdit[0][0]->slug = $slug;
$toEdit[0][0]->pageTemplate = $pageTemplate = $_POST['pageTemplate'];



//echo $posts->asXML();

$myFile = '../../data/pages.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $pages->asXML());
fclose($fh);

header('location: ../editpage.php?page='.$pageid.'&action=saved');

?>