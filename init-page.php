<?php



$settings = simplexml_load_file('data/settings.xml');

$theme = $settings->theme;
$themedir = 'themes/'.$theme;

require_once 'markdown.php';

$pages = simplexml_load_file('data/pages.xml');

if (isset($_GET['page'])) {
$thePage = $_GET['page'];
}
else {
$thePage = '';
}


$pageSlugs = array(
	//post ID => post
);

foreach($pages as $page){


$pageSlug = $page->slug;

$pageSlugs["".$pageSlug] = $page;

}


if(!$thePage==''){
$page=$pageSlugs[$thePage];
}

$pageTemplate = $page->pageTemplate;


?>