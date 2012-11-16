<?php foreach($posts as $post){ ?>
	<article>
    <h2><a href="<?php echo $rootdir; ?>/post/<?php echo $post->slug; ?>"><?php echo $post->title; ?></a></h2>

	
	
    <p>
    <?php echo $post->excerpt; ?>
  	</p>
 	</article>
    <?php } ?>


<div class="pagination">
<ul>
<?php previousPageLink("&laquo;", "<li>", "</li>"); ?>

<?php pageLinks("<li>", "</li>"); ?>

<?php nextPageLink("&raquo;", "<li>", "</li>"); ?>
</ul>
</div>