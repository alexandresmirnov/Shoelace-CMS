<?php include "header.php"; ?>

<?php



if(isset($_GET['type'])){

	$type = $_GET['type'];
	
	switch ($type) {
	
		case 'post':
			$list = new TypePost;
			break;
		case 'page':
			$list = new TypePage;
			break;
		case 'category':
			$list = new TypeCategory;
			break;
	
	}

	$list->generateList($list->listCells);
}

?>

<?php include "footer.php"; ?>