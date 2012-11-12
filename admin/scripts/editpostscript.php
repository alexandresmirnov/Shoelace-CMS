<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}



$title = $_POST['title'];
$content = $_POST['content'];
$postid = $_POST['postid'];
$excerpt = $_POST['excerpt'];
$slug = $_POST['slug'];
$categories = $_POST['categories'];
$postTemplate = $_POST['postTemplate'];

$posts = simplexml_load_file('../../data/posts.xml');


$toEdit=$posts->xpath('post[@id="'.$postid.'"]');

$toEdit[0][0]->title = $title;
$toEdit[0][0]->content = $content;
$toEdit[0][0]->excerpt = $excerpt;
$toEdit[0][0]->slug = $slug;
$toEdit[0][0]->postTemplate = $postTemplate = $_POST['postTemplate'];

unset($toEdit[0][0]->categories);

$postCategories = $toEdit[0][0]->addChild('categories');

foreach($categories as $category){
	
	$postCategories->addChild('category',$category);
	
}




//echo $posts->asXML();

$myFile = '../../data/posts.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $posts->asXML());
fclose($fh);

header('location: ../editpost.php?post='.$postid.'&action=saved');

?>