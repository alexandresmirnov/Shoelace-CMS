<?php

session_start();

if ($_SESSION["login"] != true){

header('Location: index.php?action=error');

}

$type = $_POST['type'];

if(type=='post'){




}


?>