<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}



$title = $_POST['title'];
$description = $_POST['description'];
$slug = $_POST['slug'];

$categories = simplexml_load_file('../../data/categories.xml');

$categoriescount = $categories->attributes()->count;
$categoriescount+=1;
$categories->attributes()->count = $categoriescount;
//echo $postcount;



$newcat = $categories->addChild('category');
$newcat->addAttribute('id',$categoriescount+1);
$newcat->addChild('title', $title);
$newcat->addChild('description', $description);
$newcat->addChild('slug', $slug);

//echo $posts->asXML();

$myFile = '../../data/categories.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $categories->asXML());
fclose($fh);

//header('location:'.$_SERVER['HTTP_REFERER']);
header('location:../listposts.php');
?>