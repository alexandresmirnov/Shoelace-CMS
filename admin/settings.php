<?php include "header.php"; ?>

<form action="scripts/savesettings.php" method="POST">

<label for="siteName">Site Name:</label>
<input type="text" id="siteName" name="siteName" placeholder="Site Name" class="span6" value="
<?php 

$settings = simplexml_load_file('../data/settings.xml');

echo $settings->siteName;

?>">

<label for="postsPerPage">Posts Per page:</label>
<input type="text" id="postsPerPage" name="postsPerPage" placeholder="Posts Per Page" class="span6" value="
<?php 



echo $settings->postsPerPage;

?>">





<label for="theme">Theme</label>

<select id="theme" name="theme" class="span6">


<?php

$currentTheme = $settings->theme;

foreach (glob("../themes/*", GLOB_ONLYDIR) as $themedir) {
    $themename = str_replace("../themes/", "", $themedir);
	
	if($themename==$currentTheme){
	echo "<option value=\"".$themename."\" selected=\"selected\">".$themename."</option>";
	}
	else {
	echo "<option value=\"".$themename."\">".$themename."</option>";
	}
	
	}


?>



</select>

<label for="user">Install directory:</label>
<input type="text" name="installDir" class="span6" value="<?php echo $settings->installDir; ?>">


<label for="authKey">Authentication Key:</label>
<input type="text" name="authKey" class="span6" value="<?php echo $settings->authKey; ?>">


<label for="user">Admin Username:</label>
<input type="text" name="user" class="span6" value="<?php echo $settings->user; ?>">

<label for="user">Admin Password:</label>
<input type="text" name="pass" class="span6" value="<?php echo $settings->pass; ?>">

<input type="submit" class="btn btn-large">

</form>

<?php include "footer.php"; ?>