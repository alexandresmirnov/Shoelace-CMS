<?php
session_start();

if ($_SESSION["login"] != "true"){

header("Location: index.php?action=notallowed");

$_SESSION["login"] = false;

}

$settings = simplexml_load_file('../data/settings.xml');


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $settings->siteName; ?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="css/style.css">

	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">

	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>

<section class="container">

	<div class="row">

	<section class="span8 offset2">

<?php include "nav.php"; ?>

<div class="row">
		<div class="span6 offset1">