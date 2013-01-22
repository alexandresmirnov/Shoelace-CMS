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
	
	public function generatePage($necessaryFields){
	
		$settings = simplexml_load_file('../data/settings.xml');
	
		$whatFile = $this->returnFile($this->whatFileBase);
		
		$xpathQuery = $this->xpathQuery;

		
		echo "<form action=\"".$this->formAction."\" method=\"POST\">";
	
		foreach($necessaryFields as $field){
			$name = $field[0];
			$type = $field[1];
			$label = $field[2];
			$placeholder = $field[3];
			
			switch ($type) {
				case 'text':
					echo "<label for=\"".$name."\">".$label."</label><input name=\"".$name."\" type=\"text\" placeholder=\"".$placeholder."\" value=\"\" class=\"span6\">";
					break;
				case 'mdtextarea':
					echo "<label for=\"".$name."\">".$label."</label><div id=\"wmd-button-bar\"></div><div id=\"editorWrapper\"><div id=\"preview-switcher\">Preview</div><textarea id=\"wmd-input\" name=\"content\" class=\"span6\" rows=\"20\" placeholder=\"".$placeholder."\"></textarea><div id=\"previewWrapper\"><div id=\"wmd-preview\" class=\"wmd-panel wmd-preview\"></div></div></div>";
					break;
				case 'textarea':
					echo "<label for=\"excerpt\">".$label."</label><textarea name=\"".$name."\" id=\"".$name."\" placeholder=\"".$placeholder."\" class=\"span6\" rows=\"10\"></textarea>";
					break;
				case 'heading':
					echo "<h4>".$label."</h4>";
					break;
				case 'templateDropdown':
					$currentTheme = $settings->theme;
					
					echo "<label for=\"".$name."\">".$label."</label><select id=\"".$name."\" name=\"".$name."\" class=\"span6\">";

					foreach (glob("../themes/".$currentTheme."/".$this->fileType."*") as $filename) {

						$templatename = str_replace("../themes/".$currentTheme."/", "", $filename);


						echo "<option value=\"".$templatename."\">".$templatename."</option>";
						

						
					}
					echo "</select>";
					break;
				case 'categoriesSelect':
					$categories = simplexml_load_file('../data/categories.xml');

					$count=0;
					foreach ($categories as $category){


					echo "
					<label class=\"checkbox\">
					<input type=\"checkbox\" name=\"categories[]\" value=\"".$category->title."\">".$category->title."
					</label>
					";
					


					$count++;



					}
					
					break;
			}
		}

		
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
	
	public $formAction = 'scripts/addpagescript.php';
	
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
	public $fileType = 'post';
	
	public $whatFileBase = '../data/posts.xml';
	
	public $formAction = 'scripts/addpostscript.php';
	
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
	
	public $formAction = 'scripts/addcategoryscript.php';
	
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

$type = $_GET['type'];

if($type=='post'){

	$edit = new EditPost;
	
}

if($type=='page'){

	$edit = new EditPage;
	
}

if($type=='category'){

	$edit = new EditCategory;
	
}


$edit->generatePage($edit->necessaryFields);



?>



		
<?php include "footer.php"; ?>
<?php include "footer.php"; ?>