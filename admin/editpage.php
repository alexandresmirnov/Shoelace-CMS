<?php include "header.php"; ?>

<?php

$thePage = $_GET['page'];

$pages = simplexml_load_file('../data/pages.xml');

$eachpage = $pages->page;

$toEdit=$pages->xpath('page[@id="'.$thePage.'"]');




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
<a href="../page.php?page=<?php echo $toEdit[0][0]->slug; ?>"><?php echo $toEdit[0][0]->title; ?></a> was saved successfully.

</div>


<?php

}

?>

<form action="scripts/editpagescript.php" method="POST">

<label for="title">Title:</label>
<input name="title" type="text" placeholder="Title" value="<?php echo $toEdit[0][0]->title; ?>" class="span6">

<label for="content">Page Content:</label>
<textarea name="content" class="span6" rows="20">
<?php echo $toEdit[0][0]->content; ?>
</textarea>

<input name="pageid" type="hidden" value="<?php echo $toEdit[0][0]->attributes()->id; ?>">

<h4>More Options</h4>

<label for="slug">URL Slug:</label>
<input name="slug" id="slug" type="text" placeholder="URL Slug" class="span6" value="<?php echo $toEdit[0][0]->slug; ?>">

<label for="pageTemplate">Page Template:</label>
			<select id="pageTemplate" name="pageTemplate" class="span6">

<?php 

$currentTheme = $settings->theme;
$currentPageTemplate = $toEdit[0][0]->pageTemplate;

foreach (glob("../themes/".$currentTheme."/page*") as $filename) {

	$templatename = str_replace("../themes/".$currentTheme."/", "", $filename);


	if($templatename==$currentPageTemplate){
	echo "<option value=\"".$templatename."\" selected=\"selected\">".$templatename."</option>";
	}
	else {
	echo "<option value=\"".$templatename."\">".$templatename."</option>";
	}

	
}

?>
</select>

<input type="Submit" class="btn btn-large">



</form>






<?php include "footer.php"; ?>