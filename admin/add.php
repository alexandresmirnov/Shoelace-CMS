<?php include "header.php"; 


include_once('objects.php');




?>


<?php 

$type = $_GET['type'];

if($type=='post'){

	$add = new TypePost;
	
}

if($type=='page'){

	$add = new TypePage;
	
}

if($type=='category'){

	$add = new TypeCategory;
	
}


$add->generatePage($add->necessaryFields, 'add');



?>

<?php include "footer.php"; ?>