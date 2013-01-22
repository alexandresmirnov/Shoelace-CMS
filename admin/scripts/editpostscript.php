<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}



$title = $_POST['title'];
$content = $_POST['content'];
$postid = $_POST['postid'];
$postslug = $_POST['slug'];
$excerpt = $_POST['excerpt'];
$categories = $_POST['categories'];
$postTemplate = $_POST['template'];

$posts = simplexml_load_file('../../data/posts.xml');


$toEdit=$posts->xpath("//post[contains(slug, '$postslug')]");

$toEdit[0][0]->title = $title;
$toEdit[0][0]->content = $content;
$toEdit[0][0]->excerpt = $excerpt;
$toEdit[0][0]->slug = $postslug;
$toEdit[0][0]->template = $postTemplate;

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

header('location: ../edit.php?post='.$postslug.'&action=saved');

?>