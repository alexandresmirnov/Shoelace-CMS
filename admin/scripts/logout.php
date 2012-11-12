<?php
session_start();

$_SESSION["login"] = false; 
$_SESSION["error"] = true;

header('Location: ../index.php?action=loggedout');

?>
