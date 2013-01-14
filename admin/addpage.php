<?php include "header.php"; ?>


		<form action="scripts/addpagescript.php" method="POST">

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

			<label for="slug">URL Slug:</label>
			<input name="slug" id="slug" type="text" placeholder="URL Slug" class="span6">

			<label for="pageTemplate">Page Template:</label>
			<select id="pageTemplate" name="pageTemplate" class="span6">

<?php 

$currentTheme = $settings->theme;

foreach (glob("../themes/".$currentTheme."/page*") as $filename) {

	$templatename = str_replace("../themes/".$currentTheme."/", "", $filename);


	echo "<option value=\"".$templatename."\">".$templatename."</option>";
}

?>
</select>

			<input type="Submit" class="btn btn-large" value="Create">
		</form>


		
<?php include "footer.php"; ?>