<?php

include('markdown.php');

$text = $_POST['text'];

echo Markdown($text);


?>