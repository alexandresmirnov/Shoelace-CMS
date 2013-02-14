<?php include "header.php"; 


include_once('objects.php');

?>


<?php 


$rootdir = $settings->installDir;

foreach($typeKeyValue as $key => $value){

	if(isset($_GET[$key])){
		
		$edit = new $value;
		
		$toEdit = $edit->returnToEdit();
		$editLink = '../single.php?post='.$toEdit->slug;
		
		break;
		
	}

}






if (isset($_GET['action'])) {
$action = $_GET['action'];
}
else {
$action = '';
}

if($action=='saved'){

?>
<div class="alert alert-success">


<a class="close" data-dismiss="alert">&times;</a>
<a href="<?php echo $editLink; ?>"><?php echo $toEdit->title; ?></a> was saved successfully.

</div>


<?php

}


$edit->generatePage($edit->necessaryFields, 'edit');



?>



		
<?php include "footer.php"; ?>