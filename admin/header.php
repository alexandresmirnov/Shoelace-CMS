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

	<link href="css/pagedown.css" rel="stylesheet">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="js/Markdown.Converter.js"></script>
    <script type="text/javascript" src="js/Markdown.Sanitizer.js"></script>
    <script type="text/javascript" src="js/Markdown.Editor.js"></script>

<script type="text/javascript">
$(function () {
	var converter = new Markdown.Converter();
	var editor = new Markdown.Editor(converter);
	editor.run();


$("textarea").keydown(function(e) {
    if(e.keyCode === 9) { // tab was pressed
        // get caret position/selection
        var start = this.selectionStart;
        var end = this.selectionEnd;

        var $this = $(this);
        var value = $this.val();

        // set textarea value to: text before caret + tab + text after caret
        $this.val(value.substring(0, start)
                    + "\t"
                    + value.substring(end));

        // put caret at right position again (add one for the tab)
        this.selectionStart = this.selectionEnd = start + 1;

        // prevent the focus lose
        e.preventDefault();
    }
});





$('#preview-switcher').click(function(){

var previewHeight = $('#previewWrapper').height();
$('#wmd-preview').css({
	height: previewHeight - 19
});

var visibility = $('#previewWrapper').css('visibility');

	if(visibility=='hidden'){
		$('#previewWrapper').css({
			visibility: 'visible'
		});
		
		$('#preview-switcher').text('Text');
		
		console.log('it is now visible');
	}
	
	if(visibility=='visible'){
		$('#previewWrapper').css({
			visibility: 'hidden'
		});
		
		$('#preview-switcher').text('Preview');
		
		console.log('it is now hidden');
	}
	
	
});




});
</script>
	
</head>

<body>

<section class="container">

	<div class="row">

	<section class="span8 offset2">

<?php include "nav.php"; ?>

<div class="row">
		<div class="span6 offset1">