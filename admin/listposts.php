<?php include "header.php"; ?>


<form action="scripts/deletepostscript.php" method="POST">
<table id="postslist" class="table table-striped table-bordered">
	
	<?php


$postsFile = simplexml_load_file('../data/posts.xml');
$postsCount = count($postsFile);

if($postsCount=='1'){
	$posts = $postsFile->post;
}
else {
	$posts = (array) $postsFile;
	$posts = array_reverse($posts["post"]);
}


foreach($posts as $post) {
    echo "
    <tr>
	<td class=\"checkboxcell\">
		<input type=\"checkbox\" name=\"toDelete[]\" value=\"".$post->attributes()->id."\">	
		
	</td>
	<td><a href=\"edit.php?post=".$post->slug."\">".$post->title."</a></td>
	<td class=\"datecell\">".$post->date->month."/".$post->date->day."/".$post->date->year."</td>

	</tr>
    ";
}

?>
	
	
	
	
	
	
</table>
<a href="add.php?type=post" class="btn">New Post</a>
<input type="submit" value="Delete Posts" class="btn btn-danger pull-right">
</form>

<?php include "footer.php"; ?>