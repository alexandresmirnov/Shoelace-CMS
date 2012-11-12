<?php include "header.php"; ?>


		<form action="scripts/addpagescript.php" method="POST">

			<label for="title">Title:</label>
			<input name="title" id="title" type="text" placeholder="Title" class="span6">

			<label for="content">Page Content:</label>
			<textarea name="content" id="content" placeholder="Page Content" class="span6" rows="20"></textarea>

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

			<input type="Submit" class="btn btn-large">
		</form>


		
<?php include "footer.php"; ?>