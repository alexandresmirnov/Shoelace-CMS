<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}



$title = $_POST['title'];
$content = $_POST['content'];
$excerpt = $_POST['excerpt'];
$slug = $_POST['slug'];
$categories = $_POST['categories'];
$postTemplate = $_POST['postTemplate'];

$posts = simplexml_load_file('../../data/posts.xml');

$postcount = $posts->attributes()->count;
$postcount+=1;
$posts->attributes()->count = $postcount;
//echo $postcount;



$newpost = $posts->addChild('post');
$newpost->addAttribute('id',$postcount+1);
$newpost->addChild('title', $title);
$newpost->addChild('excerpt', $excerpt);
$newpost->addChild('slug', $slug);
$date = $newpost->addChild('date');
$date->addChild('day',date('j'));
$date->addChild('month',date('n'));
$date->addChild('year',date('Y'));
$newpost->addChild('content', $content);
$newpost->addChild('postTemplate', $postTemplate);
$postCategories = $newpost->addChild('categories');

foreach($categories as $category){
	
	$postCategories->addChild('category',$category);
	
}


//echo $posts->asXML();

$myFile = '../../data/posts.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $posts->asXML());
fclose($fh);

//header('location:'.$_SERVER['HTTP_REFERER']);
header('location:../listposts.php');
?>