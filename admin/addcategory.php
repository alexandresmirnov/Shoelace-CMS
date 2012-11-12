<?php include "header.php"; ?>


		<form action="scripts/addcategoryscript.php" method="POST">

			<label for="title">Title:</label>
			<input name="title" id="title" type="text" placeholder="Title" class="span6">

			<label for="descriptionTextarea">Description:</label>
			<textarea name="description" id="descriptionTextarea" placeholder="Category Description" class="span6" rows="20"></textarea>

			<h4>More Options</h4>

			<label for="slug">URL Slug:</label>
			<input name="slug" id="slug" type="text" placeholder="URL Slug" class="span6">

			<input type="Submit" class="btn btn-large">
		</form>


		
<?php include "footer.php"; ?>