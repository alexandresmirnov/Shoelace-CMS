<?php include "header.php"; ?>


<form action="scripts/deletecatscript.php" method="POST">
<table id="catslist" class="table table-striped table-bordered">
	
	<?php


$categoriesFile = simplexml_load_file('../data/categories.xml');
$categoriesCount = count($categoriesFile);

if($categoriesCount=='1'){
	$categories = $postsFile->post;
}
else {
	$categories = (array) $categoriesFile;
	$categories = array_reverse($categories["category"]);
}


foreach($categories as $category) {
    echo "
    <tr>
	<td class=\"checkboxcell\">
		<input type=\"checkbox\" name=\"toDelete[]\" value=\"".$category->attributes()->id."\">	
		
	</td>
	<td><a href=\"editcategory.php?category=".$category->attributes()->id."\">".$category->title."</a></td>

	</tr>
    ";
}

?>
	
	
	
	
	
	
</table>
<a href="addcategory.php" class="btn">New Category</a>
<input type="submit" value="Delete Categories" class="btn btn-danger pull-right">
</form>

<?php include "footer.php"; ?>