<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}

$posts = simplexml_load_file('../../data/posts.xml');


$postsToDelete = $_POST['toDelete'];
$N = count($postsToDelete);
    echo("You deleted $N posts ");
    for($i=0; $i < $N; $i++)
    {
		$todelete=$posts->xpath('post[@id="'.$postsToDelete[$i].'"]');
		unset($todelete[0][0]);
    }




$myFile = '../../data/posts.xml';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $posts->asXML());
fclose($fh);

header('location:'.$_SERVER['HTTP_REFERER']);

?>