<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}



$title = $_POST['title'];
$description = $_POST['description'];
$slug = $_POST['slug'];
$catid = $_POST['catid'];

$categories = simplexml_load_file('../../data/categories.xml');

$toEdit=$categories->xpath('category[@id="'.$catid.'"]');



$toEdit[0][0]->title = $title;
$toEdit[0][0]->description = $description;
$toEdit[0][0]->slug = $slug;

//echo $posts->asXML();

$myFile = '../../data/categories.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $categories->asXML());
fclose($fh);

//header('location:'.$_SERVER['HTTP_REFERER']);
header('location:../listposts.php');
?>