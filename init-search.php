<?php


$settings = simplexml_load_file('data/settings.xml');

$rootdir = $settings->installDir."/";


$theme = $settings->theme;
$themedir = 'themes/'.$theme;

$themeDirectory = $rootdir.'/'.$themedir;

require_once 'markdown.php';

$postsPerPage = $settings->postsPerPage;

$postsFile = simplexml_load_file('data/posts.xml');
$posts = (array) $postsFile;
$posts = array_reverse($posts["post"]);

if (isset($_GET['query'])) {
$query = $_GET['query'];
}
else {
$query = '';
}

/*
foreach($posts as $post){

	$toSearchTitle = strtolower($post->title);
	$toSearchContent = strtolower($post->content);
	$toSearch = $toSearchTitle.$toSearchContent;
	
	$query = strtolower($query);
	
	if (strpos($toSearch,$query) !== false) {
		$postsSearch[] = $post;
	}

}
*/

$query = strtolower($query);



$postsSearch = $postsFile->xpath("//post[contains(translate(content, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '".$query."')] |// //post[contains(translate(title, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '".$query."')]");
$posts = array_reverse($postsSearch);


if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
else {
	$page = 1;
}

$nextPage = $page+1;
$previousPage = $page-1;


$whereToStart = $postsPerPage*($page-1);
$upToWhere = $postsPerPage*$page;
$howManyPosts = count($posts);



$posts = array_slice($posts, $whereToStart , $postsPerPage);


function previousPageLink($link, $before = "", $after=""){

global $whereToStart;
global $upToWhere;
global $howManyPosts;

global $page;
global $previousPage;

if($whereToStart>0){

echo $before."<a href=\"".$_SERVER['PHP_SELF']."?page=".$previousPage."\">".$link."</a>".$after;

}

};

function nextPageLink($link, $before = "", $after=""){

global $whereToStart;
global $upToWhere;
global $howManyPosts;

global $page;
global $nextPage;

if($upToWhere<$howManyPosts){
echo $before."<a href=\"".$_SERVER['PHP_SELF']."?page=".$nextPage."\">".$link."</a>".$after;
}

};

function pageLinks($before, $after){

global $whereToStart;
global $upToWhere;
global $howManyPosts;
global $postsPerPage;

global $page;
global $nextPage;

$howManyPages = $howManyPosts/$postsPerPage;
$howManyPages = ceil($howManyPages);

for($i=1; $i <= $howManyPages; $i++){

	if($i==1){
		echo $before."<a href=\"".$_SERVER['PHP_SELF']."\">".$i."</a>".$after;

	}
	else {
		echo $before."<a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a>".$after;
	}
}

}






?>