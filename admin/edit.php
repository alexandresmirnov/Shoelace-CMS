<?php include "header.php"; 

class Edit {
	
	public $whatFileBase;
	public $xpathQuery;
	public $urlparam;
	
	public $formAction;
	
	public $necessaryFields;
	
	public function __construct(){
	
		$this->xpathQuery = "//".$this->xmlName."[contains(slug, '".$this->getParam($this->urlparam)."')]";
		
	}
	
	public function returnFile($whatFileBase){
		
		$whatFile = simplexml_load_file($whatFileBase);
		return $whatFile;
		
	}
	

	
	
	
	public function getParam($urlparam){
	
		if (isset($_GET[$urlparam])) {
			return $_GET[$urlparam];
		}
		else {
			return '';
		}
		
	}
	
	public function runXpath($whatFile, $xpathQuery){
		
		$toEdit = $whatFile->xpath($xpathQuery);
		
		return $toEdit;
	
	}
	
	public function returnToEdit(){
		$whatFile = $this->returnFile($this->whatFileBase);
		
		$xpathQuery = $this->xpathQuery;
		
		$toEdit = $this->runXpath($whatFile, $xpathQuery);
		
		return $toEdit[0][0];
	}
	
	public function generatePage($necessaryFields){
	
		$settings = simplexml_load_file('../data/settings.xml');
	
		$whatFile = $this->returnFile($this->whatFileBase);
		
		$xpathQuery = $this->xpathQuery;
		
		$toEdit = $this->runXpath($whatFile, $xpathQuery);
		
		
		$toEdit = $toEdit[0][0];
		
		echo "<form action=\"".$this->formAction."\" method=\"POST\">";
	
		foreach($necessaryFields as $field){
			$name = $field[0];
			$type = $field[1];
			$label = $field[2];
			$placeholder = $field[3];
			
			switch ($type) {
				case 'text':
					echo "<label for=\"".$name."\">".$label."</label><input name=\"".$name."\" type=\"text\" placeholder=\"".$placeholder."\" value=\"".$toEdit->$name."\" class=\"span6\">";
					break;
				case 'mdtextarea':
					echo "<label for=\"".$name."\">".$label."</label><div id=\"wmd-button-bar\"></div><div id=\"editorWrapper\"><div id=\"preview-switcher\">Preview</div><textarea id=\"wmd-input\" name=\"content\" class=\"span6\" rows=\"20\" placeholder=\"".$placeholder."\">".stripslashes($toEdit->$name)."</textarea><div id=\"previewWrapper\"><div id=\"wmd-preview\" class=\"wmd-panel wmd-preview\"></div></div></div>";
					break;
				case 'textarea':
					echo "<label for=\"excerpt\">".$label."</label><textarea name=\"".$name."\" id=\"".$name."\" placeholder=\"".$placeholder."\" class=\"span6\" rows=\"10\">".$toEdit->$name."</textarea>";
					break;
				case 'heading':
					echo "<h4>".$label."</h4>";
					break;
				case 'templateDropdown':
					$currentTheme = $settings->theme;
					$currentTemplate = $toEdit->template;
					
					echo "<label for=\"".$name."\">".$label."</label><select id=\"".$name."\" name=\"".$name."\" class=\"span6\">";

					foreach (glob("../themes/".$currentTheme."/".$this->fileType."*") as $filename) {

						$templatename = str_replace("../themes/".$currentTheme."/", "", $filename);


						if($templatename==$currentTemplate){
						echo "<option value=\"".$templatename."\" selected=\"selected\">".$templatename."</option>";
						}
						else {
						echo "<option value=\"".$templatename."\">".$templatename."</option>";
						}

						
					}
					echo "</select>";
					break;
				case 'categoriesSelect':
					
					$postCategories = $toEdit->categories->category;
					$postCategories = (array) $postCategories;

					$categories = simplexml_load_file('../data/categories.xml');

					$count=0;
					foreach ($categories as $category){


					if (in_array($category->title, $postCategories)) {
					echo "
					<label class=\"checkbox\">
					<input type=\"checkbox\" name=\"categories[]\" value=\"".$category->title."\" checked=\"checked\">".$category->title."
					</label>
					";
					}
					else {
					echo "
					<label class=\"checkbox\">
					<input type=\"checkbox\" name=\"categories[]\" value=\"".$category->title."\">".$category->title."
					</label>
					";
					}


					$count++;



					}
					
					break;
			}
		}
		
		echo "<input name=\"pageid\" type=\"hidden\" value=\"".$toEdit->attributes()->id."\">";
		
		echo "<input type=\"Submit\" class=\"btn btn-large\" value=\"".$this->buttonText."\">";
		
		echo "</form>";
		
		

	}
	
	public function test(){
		return 'test';
	}
	
}

class EditPage extends Edit {
	
	
	public $urlparam = 'page';
	public $xmlName = 'page';
	public $fileType = 'page';
	
	public $whatFileBase = '../data/pages.xml';
	
	public $formAction = 'scripts/editpagescript.php';
	
	public $buttonText = 'Save Page';

	
	public $necessaryFields = array(
		array('title', 'text', 'Title:', 'Title'),
		array('content', 'mdtextarea', 'Page Content:', 'Page Content'),
		array('moreoptions', 'heading', 'More Options', 'More Options'),
		array('slug', 'text', 'URL Slug: ', 'URL Slug'),
		array('template', 'templateDropdown', 'Page Template: ', 'Page Template')
	);
}

class EditPost extends Edit {
	
	
	public $urlparam = 'post';
	public $xmlName = 'post';
	public $fileType = 'single';
	
	public $whatFileBase = '../data/posts.xml';
	
	public $formAction = 'scripts/editpostscript.php';
	
	public $buttonText = 'Save Post';

	
	public $necessaryFields = array(
		array('title', 'text', 'Title:', 'Title'),
		array('content', 'mdtextarea', 'Post Content:', 'Page Content'),
		array('moreoptions', 'heading', 'More Options', 'More Options'),
		array('excerpt', 'textarea', 'Post Excerpt:', 'Post Excerpt'),
		array('slug', 'text', 'URL Slug: ', 'URL Slug'),
		array('categories[]', 'categoriesSelect', 'Post Categories: ', 'Post Categories'),
		array('template', 'templateDropdown', 'Post Template: ', 'Post Template')
	);
}

class EditCategory extends Edit {
	
	
	public $urlparam = 'category';
	public $xmlName = 'category';
	public $fileType = 'category';
	
	public $whatFileBase = '../data/categories.xml';
	
	public $formAction = 'scripts/editcategoryscript.php';
	
	public $buttonText = 'Save Category';

	
	public $necessaryFields = array(
		array('title', 'text', 'Title:', 'Title'),
		array('description', 'textarea', 'Description:', 'Description'),
		array('moreoptions', 'heading', 'More Options', 'More Options'),
		array('slug', 'text', 'URL Slug: ', 'URL Slug'),
	);
}




?>


<?php 
$settings = simplexml_load_file('../data/settings.xml');

$rootdir = $settings->installDir;

if(isset($_GET['post'])){

	$edit = new EditPost;
	
	$toEdit = $edit->returnToEdit();
	
	$editLink = '../single.php?post='.$toEdit->slug;
	
}

if(isset($_GET['page'])){

	$edit = new EditPage;
	
	$toEdit = $edit->returnToEdit();
	
	$editLink = $rootdir.'/'.$toEdit->slug;
	
}

if(isset($_GET['category'])){

	$edit = new EditCategory;
	
	$toEdit = $edit->returnToEdit();
	
	$editLink = '../category.php?category='.$toEdit->slug;
	
}





if (isset($_GET['action'])) {
$action = $_GET['action'];
}
else {
$action = '';
}

if($action=='saved'){

?>
<div class="alert alert-success">


<a class="close" data-dismiss="alert">&times;</a>
<a href="<?php echo $editLink; ?>"><?php echo $toEdit->title; ?></a> was saved successfully.

</div>


<?php

}


$edit->generatePage($edit->necessaryFields);



?>



		
<?php include "footer.php"; ?>