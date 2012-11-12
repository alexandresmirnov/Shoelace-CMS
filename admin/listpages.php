<?php include "header.php"; ?>


<form action="scripts/deletepagescript.php" method="POST">
<table id="postslist" class="table table-striped table-bordered">
	
	<?php


$pagesFile = simplexml_load_file('../data/pages.xml');
$pagesCount = count($pagesFile);

if($pagesCount=='1'){
	$pages = $pagesFile->page;
}
else {
	$pages = (array) $pagesFile;
	$pages = array_reverse($pages["page"]);
}

foreach($pages as $page) {
    echo "
    <tr>
	<td class=\"checkboxcell\">
		<input type=\"checkbox\" name=\"toDelete[]\" value=\"".$page->attributes()->id."\">	
		
	</td>
	<td><a href=\"editpage.php?page=".$page->attributes()->id."\">".$page->title."</a></td>
	</tr>
    ";
}

?>
	
	
	
	
	
	
</table>
<a href="addpost.php" class="btn">New Page</a>
<input type="submit" value="Delete Pages" class="btn btn-danger pull-right">
</form>

<?php include "footer.php"; ?>
