<?php include_once "header.php"; 

$page = $shoelace->page;

?>


	<article>
    <h2><a href="<?php echo $shoelace->rootDir; ?>/<?php echo $page->slug; ?>"><?php echo $page->title; ?></a></h2>

    <p>
    <?php echo $page->content; ?>
  	</p>
 	</article>



<?php include_once "footer.php"; ?>