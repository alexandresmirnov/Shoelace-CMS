<?php include_once "header.php"; 

$post = $shoelace->post;

?>


	<article>
    <h2><a href="<?php echo $shoelace->rootDir; ?>/post/<?php echo $post->slug; ?>"><?php echo $post->title; ?></a></h2>

	<?php $shoelace->listCategories($post); ?>
	
    <p>
    <?php echo Markdown($post->content); ?>
  	</p>
 	</article>



<?php include_once "footer.php"; ?>