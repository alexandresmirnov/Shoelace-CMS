<?php 

$settings = simplexml_load_file('data/settings.xml');

$rootdir = $settings->installDir;


$theme = $settings->theme;
$themedir = 'themes/'.$theme;

$themeDirectory = $rootdir."/".$themedir;

require_once 'markdown.php';

?>