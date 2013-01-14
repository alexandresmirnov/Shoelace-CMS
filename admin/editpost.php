<?php include "header.php"; ?>


<?php

$thePost = $_GET['post'];

$posts = simplexml_load_file('../data/posts.xml');

$eachpost = $posts->post;

$toEdit=$posts->xpath("//post[contains(slug, '$thePost')]");



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



<form action="scripts/editpostscript.php" method="POST">

<label for="title">Title:</label>
<input name="title" id="title" type="text" placeholder="Title" value="<?php echo $toEdit[0][0]->title; ?>" class="span6">

<label for="contentTextarea">Post Content:</label>


     <div id="wmd-button-bar">
	 
     </div>
	 
	 <div id="editorWrapper">
	 <div id="preview-switcher">Preview</div>
<textarea id="wmd-input" name="content" class="span6" rows="20"><?php echo $toEdit[0][0]->content; ?></textarea>


<div id="previewWrapper">
<div id="wmd-preview" class="wmd-panel wmd-preview"></div>
</div>

</div>

<h4>More Options</h4>

<label for="excerpt">Post Excerpt:</label>
<textarea name="excerpt" id="excerpt" placeholder="Post Excerpt" class="span6" rows="10">
<?php echo $toEdit[0][0]->excerpt; ?>
</textarea>



<label for="slug">URL Slug:</label>
<input name="slug" id="slug" type="text" placeholder="URL Slug" class="span6" value="<?php echo $toEdit[0][0]->slug; ?>">


<label for="postCategories">Post Categories:</label>
			

<?php

$postCategories = $toEdit[0][0]->categories->category;
$postCategories = (array) $postCategories;

$categories = simplexml_load_file('../data/categories.xml');

$count=0;
foreach ($categories as $category){


if (in_array($category->title, $postCategories)) {
echo "
<label class=\"checkbox\">
<input type=\"checkbox\" name=\"categories[]\" value=\"".$category->title."\" checked=\"checked\">".$category->title."
</label>
";
}
else {
echo "
<label class=\"checkbox\">
<input type=\"checkbox\" name=\"categories[]\" value=\"".$category->title."\">".$category->title."
</label>
";
}


$count++;



}

?>


<label for="postTemplate">Post Template:</label>
			<select id="postTemplate" name="postTemplate" class="span6">

<?php 

$currentTheme = $settings->theme;
$currentPostTemplate = $toEdit[0][0]->postTemplate;

foreach (glob("../themes/".$currentTheme."/single*") as $filename) {

	$templatename = str_replace("../themes/".$currentTheme."/", "", $filename);


	if($templatename==$currentPostTemplate){
	echo "<option value=\"".$templatename."\" selected=\"selected\">".$templatename."</option>";
	}
	else {
	echo "<option value=\"".$templatename."\">".$templatename."</option>";
	}

	
}

?>


</select>

<input name="postid" type="hidden" value="<?php echo $toEdit[0][0]->attributes()->id; ?>">

<input type="Submit" class="btn btn-large" value="Save">

</form>






<?php include "footer.php"; ?>