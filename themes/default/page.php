<?php include_once "header.php"; ?>


	<article>
    <h2><a href="single.php?post=<?php echo $page->slug; ?>"><?php echo $page->title; ?></a></h2>

    <p>
    <?php echo $page->content; ?>
  	</p>
 	</article>



<?php include_once "footer.php"; ?>