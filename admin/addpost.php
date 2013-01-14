<?php include "header.php"; ?>


		<form action="scripts/addpostscript.php" method="POST">

			<label for="title">Title:</label>
			<input name="title" id="title" type="text" placeholder="Title" class="span6">

			<label for="contentTextarea">Post Content:</label>


     <div id="wmd-button-bar">
	 
     </div>
	 
	 <div id="editorWrapper">
	 <div id="preview-switcher">Preview</div>
<textarea id="wmd-input" name="content" class="span6" rows="20"></textarea>


<div id="previewWrapper">
<div id="wmd-preview" class="wmd-panel wmd-preview"></div>
</div>

</div>

			<h4>More Options</h4>

			<label for="excerpt">Post Excerpt:</label>

			<textarea name="excerpt" id="excerpt" placeholder="Post Excerpt" class="span6" rows="10"></textarea>

			<label for="slug">URL Slug:</label>
			<input name="slug" id="slug" type="text" placeholder="URL Slug" class="span6">

	<label for="postCategories">Post Categories:</label>
			

<?php 

$categories = simplexml_load_file('../data/categories.xml');

foreach ($categories as $category){

echo "
<label class=\"checkbox\">
<input type=\"checkbox\" name=\"categories[]\" value=\"".$category->title."\">".$category->title."
</label>
";

}

?>

		
			
<label for="postTemplate">Post Template:</label>
			<select id="postTemplate" name="postTemplate" class="span6">

<?php 

$currentTheme = $settings->theme;

foreach (glob("../themes/".$currentTheme."/single*") as $filename) {

	$templatename = str_replace("../themes/".$currentTheme."/", "", $filename);


	echo "<option value=\"".$templatename."\">".$templatename."</option>";
}

?>
</select>

			<input type="Submit" class="btn btn-large" value="Create">
		</form>


		
<?php include "footer.php"; ?>