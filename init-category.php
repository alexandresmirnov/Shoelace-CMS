<?php



$settings = simplexml_load_file('data/settings.xml');

$rootdir = $settings->installDir."/";


$theme = $settings->theme;
$themedir = 'themes/'.$theme;

$themeDirectory = $rootdir.'/'.$themedir;

require_once 'markdown.php';

$postsPerPage = $settings->postsPerPage;


if (isset($_GET['cat'])) {
	$cat = $_GET['cat'];
}
else {
	$cat = "";
}

$postsFile = simplexml_load_file('data/posts.xml');



$postsSearch = $postsFile->xpath("//post[contains(categories, '".$cat."')]");
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

global $cat;

if($whereToStart>0){

if($previousPage>1){

echo $before."<a href=\"".$_SERVER['PHP_SELF']."?cat=".$cat."&page=".$previousPage."\">".$link."</a>".$after;

}
else {

echo $before."<a href=\"".$_SERVER['PHP_SELF']."?cat=".$cat."\">".$link."</a>".$after;

}

}

};

function nextPageLink($link, $before = "", $after=""){

global $whereToStart;
global $upToWhere;
global $howManyPosts;

global $page;
global $nextPage;

global $cat;

if($upToWhere<$howManyPosts){
echo $before."<a href=\"".$_SERVER['PHP_SELF']."?cat=".$cat."&page=".$nextPage."\">".$link."</a>".$after;
}

};

function pageLinks($before, $after){

global $whereToStart;
global $upToWhere;
global $howManyPosts;
global $postsPerPage;

global $page;
global $nextPage;

global $cat;

$howManyPages = $howManyPosts/$postsPerPage;
$howManyPages = ceil($howManyPages);

for($i=1; $i <= $howManyPages; $i++){

	if($i==1){
		echo $before."<a href=\"".$_SERVER['PHP_SELF']."?cat=".$cat."\">".$i."</a>".$after;

	}
	else {
		echo $before."<a href=\"".$_SERVER['PHP_SELF']."?cat=".$cat."&page=".$i."\">".$i."</a>".$after;
	}
}

}

function listCategories($before = "<li>", $after = "</li>"){

global $post;

$categories = $post->categories->category;

if(isset($categories)){



foreach($categories as $category){

echo $before."<a href=\"category.php?category=".$category."\">".$category."</a>".$after;

}

}

}






?>