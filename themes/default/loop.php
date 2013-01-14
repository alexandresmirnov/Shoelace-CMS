<?php foreach(shoelaceinfo('posts') as $post){ ?>
	<article>
    <h2><a href="<?php echo shoelaceinfo('rootdir'); ?>/post/<?php echo $post->slug; ?>"><?php echo $post->title; ?></a></h2>

	<?php listCategories($post); ?>
	
    <p>
    <?php echo $post->excerpt; ?>
  	</p>
 	</article>
    <?php } ?>


<div class="pagination">
<ul>
<?php previousPageLink(); ?>

<?php pageLinks(false); ?>

<?php nextPageLink(); ?>
</ul>
</div>