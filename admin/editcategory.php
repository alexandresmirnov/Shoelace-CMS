<?php include "header.php"; ?>

<?php

$theCategory = $_GET['category'];

$categories = simplexml_load_file('../data/categories.xml');

$eachcategory = $categories->category;

$toEdit=$categories->xpath('category[@id="'.$theCategory.'"]');




?>

<?php

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
<a href="../single.php?post=<?php echo $toEdit[0][0]->slug; ?>"><?php echo $toEdit[0][0]->title; ?></a> was saved successfully.

</div>


<?php

}

?>

		<form action="scripts/editcategoryscript.php" method="POST">

			<label for="title">Title:</label>
			<input name="title" id="title" type="text" placeholder="Title" value="<?php echo $toEdit[0][0]->title; ?>" class="span6">

			<label for="descriptionTextarea">Description:</label>
			<textarea name="description" id="descriptionTextarea" placeholder="Category Description" class="span6" rows="20"><?php echo $toEdit[0][0]->description; ?></textarea>

			<h4>More Options</h4>

			<label for="slug">URL Slug:</label>
			<input name="slug" id="slug" type="text" placeholder="URL Slug" class="span6" value="<?php echo $toEdit[0][0]->slug; ?>">

			<input name="catid" type="hidden" value="<?php echo $toEdit[0][0]->attributes()->id; ?>">
			
			<input type="Submit" class="btn btn-large">
		</form>


		
<?php include "footer.php"; ?>