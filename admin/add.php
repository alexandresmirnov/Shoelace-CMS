<?php include "header.php"; 


include_once('objects.php');




?>


<?php 

$type = $_GET['type'];

foreach($typeKeyValue as $key => $value){

	if($type==$key){
		
		$add = new $value;

		break;
		
	}

}


$add->generatePage($add->necessaryFields, 'add');



?>

<?php include "footer.php"; ?>