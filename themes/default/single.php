<?php include_once "header.php"; ?>


	<article>
    <h2><a href="single.php?post=<?php echo $post->slug; ?>"><?php echo $post->title; ?></a></h2>

    <p>
    <?php echo Markdown($post->content); ?>
  	</p>
 	</article>



<?php include_once "footer.php"; ?>