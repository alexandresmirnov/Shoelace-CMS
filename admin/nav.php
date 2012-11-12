<?php 

$settings = simplexml_load_file('../data/settings.xml');

?>


<div class="navbar" id="navigation">
  <div class="navbar-inner">
    <div class="container">
 <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
      <!-- Be sure to leave the brand out there if you want it shown -->
      <a class="brand" href="../"><?php echo $settings->siteName; ?></a>

<div class="nav-collapse collapse">

    <ul class="nav pull-right">
		

<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Posts <b class="caret"></b></a>

  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    	<li>
			<a href="listposts.php">
				View Posts
			</a>
		</li>
		<li>
			<a href="addpost.php">
				New Post
			</a>
		</li>
  </ul>
</li>

<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages <b class="caret"></b></a>

  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    	<li>
			<a href="listpages.php">
				Pages
			</a>
		</li>
		<li>
			<a href="addpage.php">
				New Page
			</a>
		</li>
  </ul>
		</li>

		<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <b class="caret"></b></a>

  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    	<li>
			<a href="listcategories.php">
				Categories
			</a>
		</li>
		<li>
			<a href="addcategory.php">
				New Category
			</a>
		</li>
  </ul>
		</li>
		
		
		<li>
			<a href="settings.php">
				Settings
			</a>
		</li>
    </ul>

</div>

 
    </div>
  </div>
</div>