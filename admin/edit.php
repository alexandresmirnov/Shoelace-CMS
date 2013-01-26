<?php include "header.php"; 


include_once('objects.php');

?>


<?php 
$settings = simplexml_load_file('../data/settings.xml');

$rootdir = $settings->installDir;

if(isset($_GET['post'])){

	$edit = new TypePost;
	
	$toEdit = $edit->returnToEdit();
	
	$editLink = '../single.php?post='.$toEdit->slug;
	
}

if(isset($_GET['page'])){

	$edit = new TypePage;
	
	$toEdit = $edit->returnToEdit();
	
	$editLink = $rootdir.'/'.$toEdit->slug;
	
}

if(isset($_GET['category'])){

	$edit = new TypeCategory;
	
	$toEdit = $edit->returnToEdit();
	
	$editLink = '../category.php?category='.$toEdit->slug;
	
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