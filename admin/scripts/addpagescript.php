<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}



$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$pageTemplate = $_POST['pageTemplate'];

$pages = simplexml_load_file('../../data/pages.xml');

$pagecount = $pages->attributes()->count;
$pagecount+=1;
$pages->attributes()->count = $pagecount;
//echo $postcount;



$newpage = $pages->addChild('page');
$newpage->addAttribute('id',$pagecount+1);
$newpage->addChild('title', $title);
$newpage->addChild('slug', $slug);
$date = $newpage->addChild('date');
$date->addChild('day',date('j'));
$date->addChild('month',date('n'));
$date->addChild('year',date('Y'));
$newpage->addChild('content', $content);
$newpage->addChild('pageTemplate', $pageTemplate);


//echo $posts->asXML();

$myFile = '../../data/pages.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $pages->asXML());
fclose($fh);

///header('location:'.$_SERVER['HTTP_REFERER']);
header('location:../listpages.php');
?>