<?php foreach($shoelace->posts as $post){ ?>
	<article>
    <h2><a href="<?php echo $shoelace->rootDir; ?>/post/<?php echo $post->slug; ?>"><?php echo $post->title; ?></a></h2>

	<?php $shoelace->listCategories($post); ?>
	
    <p>
    <?php echo $post->excerpt; ?>
  	</p>
 	</article>
    <?php } ?>


<div class="pagination">
<ul>
<?php $shoelace->previousPageLink(); ?>

<?php $shoelace->pageLinks(false); ?>

<?php $shoelace->nextPageLink(); ?>
</ul>
</div>