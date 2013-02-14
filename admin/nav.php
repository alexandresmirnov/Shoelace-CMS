
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
			<a href="list.php?type=post">
				View Posts
			</a>
		</li>
		<li>
			<a href="add.php?type=post">
				New Post
			</a>
		</li>
  </ul>
</li>

<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages <b class="caret"></b></a>

  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    	<li>
			<a href="list.php?type=page">
				Pages
			</a>
		</li>
		<li>
			<a href="add.php?type=page">
				New Page
			</a>
		</li>
  </ul>
		</li>

		<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <b class="caret"></b></a>

  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    	<li>
			<a href="list.php?type=category">
				Categories
			</a>
		</li>
		<li>
			<a href="add.php?type=category">
				New Category
			</a>
		</li>
  </ul>
		</li>
		
		
		<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings <b class="caret"></b></a>

  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    	<li>
			<a href="settings.php">
				Settings
			</a>
		</li>
		<li>
			<a href="scripts/logout.php">
				Log Out
			</a>
		</li>
  </ul>
		</li>
    </ul>

</div>

 
    </div>
  </div>
</div>