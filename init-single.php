<?php



$settings = simplexml_load_file('data/settings.xml');

$rootdir = $settings->installDir."/";


$theme = $settings->theme;
$themedir = 'themes/'.$theme;

$themeDirectory = $rootdir.'/'.$themedir;

require_once 'markdown.php';

$posts = simplexml_load_file('data/posts.xml');


if (isset($_GET['post'])) {
$thePost = $_GET['post'];
}
else {
$thePost = '';
}


$postSlugs = array(
	//post ID => post
);

foreach($posts as $post){


$postSlug = $post->slug;

$postSlugs["".$postSlug] = $post;

}

$post=$postSlugs[$thePost];


$postTemplate = $post->postTemplate;

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