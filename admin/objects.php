<?php

class Type {
	
	//add.php and edit.php variables
	public $whatFileBase;
	public $xpathQuery;
	public $urlparam;
	
	public $addFormAction = 'scripts/addscript.php';
	public $editFormAction = 'scripts/editscript.php';
	
	public $necessaryFields;
	
	//addscript.php variables
	public $toSave = array();
	public $XMLfile;
	
	//add.php and edit.php functions
	//hacky way of setting a property using variables
	public function __construct(){
	
	
		$this->xpathQuery = "//".$this->XMLname."[contains(slug, '".$this->getParam($this->urlparam)."')]";
		
	}
	
	public function returnFile($whatFileBase){
		
		if (file_exists($whatFileBase)) {
			$whatFile = simplexml_load_file($whatFileBase);
		} else {
			$whatFile = simplexml_load_file('../'.$whatFileBase);
		}
		
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
	
	//Runs the xpath query and returns the results as an array
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
	
	//Generates the edit page with text boxes and stuff
	public function generatePage($necessaryFields, $fieldsType){
	
		$settings = simplexml_load_file('../data/settings.xml');
	
		$whatFile = $this->returnFile($this->whatFileBase);
		
		$xpathQuery = $this->xpathQuery;

		$toEdit = $this->runXpath($whatFile, $xpathQuery);
		
		$toEdit = $toEdit[0][0];
		
		$id = $toEdit->attributes()->id;
		
		if($fieldsType=='add'){
			$formAction = $this->addFormAction;
		}
		if($fieldsType=='edit'){
			$formAction = $this->editFormAction;
		}
		
		
		echo "<form action=\"".$formAction."\" method=\"POST\">";
		
		echo "<input type=\"hidden\" name=\"type\"value=\"".$this->XMLname."\">";
		
		echo "<input type=\"hidden\" name=\"id\"value=\"".$id."\">";
	
		foreach($necessaryFields as $field){
			$name = $field[0];
			$type = $field[1];
			$label = $field[2];
			$placeholder = $field[3];
			
			if($fieldsType=='add'){
				$toEdit->$name = '';
			}
			if($fieldsType=='edit'){
				
			}
			
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

		
		echo "<input type=\"Submit\" class=\"btn btn-large\" value=\"".$this->buttonText."\">";
		
		echo "</form>";
		
		

	}
	
	
	//addscript.php
	//$toSave = array of stuff to save
	//$entryName = name of each xml node, e.g. 'post' or 'page'
	//$XMLfilename = file into which stuff is saved, e.g. '../../data/posts.xml'
	public function writeFields($toSave, $entryName, $XMLfilename){
		
		$XMLfile = simplexml_load_file($XMLfilename);
		
		$IDcount = $XMLfile->attributes()->count;
		$IDcount += 1;
		$XMLfile->attributes()->count = $IDcount;
		
		$newEntry = $XMLfile->addChild($entryName);
		
		
		if($newEntry->attributes()->id==''){
			$newEntry->addAttribute('id',$IDcount);
		}
		else{
			$newEntry->attributes()->id = $IDcount;
		}
		
		foreach($toSave as $node){
			
			if(isset($_POST[$node])){
				$value = $_POST[$node];
			}
			
			if($node=='categories'){
				$newCategories = $newEntry->addChild('categories');
				
				foreach($value as $category){
					$newCategories->addChild('category',$category);
				}
			}
			elseif($node=='date'){
				$newDate = $newEntry->addChild('date');

				
				date_default_timezone_set('America/Los_Angeles');
				
				$newDate->addChild('day',date('j'));
				$newDate->addChild('month',date('n'));
				$newDate->addChild('year',date('Y'));
				
			}
			else {
				$newEntry->addChild($node, $value);
			}
		}
		
		$fh = fopen($XMLfilename, 'w') or die("can't open file");
		fwrite($fh, $XMLfile->asXML());
		fclose($fh);
		
		header('Location: ../edit.php?'.$entryName.'='.$newEntry->slug.'&action=saved');
	}
	
	public function editFields($toSave, $entryName, $XMLfilename){
		
		$XMLfile = simplexml_load_file($XMLfilename);
		$type = $_POST['type'];
		$id = $_POST['id'];
		
		$xpathQuery = "//".$this->XMLname."[contains(@id, '".$id."')]";
		$toEdit = $this->runXpath($XMLfile, $xpathQuery)[0][0];

		
		foreach($toSave as $node){
			if(isset($_POST[$node])){
				$value = $_POST[$node];
			}

				if($node!='date' && $node!='categories'){
				
					//echo $toEdit->$node;
					
					//echo $node.' : '.$value;
					
					//echo $node.' : '.$value.'<br>';
					
					$toEdit->$node = $value;
					
					//echo $toEdit->$node;
					
					
					
				}
				
				echo $toEdit->slug;
			
		}
		$fh = fopen($XMLfilename, 'w') or die("can't open file");
		fwrite($fh, $XMLfile->asXML());
		fclose($fh);
		
		header('Location: ../edit.php?'.$type.'='.$toEdit->slug.'&action=saved');
		
	}
	
}


class TypePage extends Type {
	
	
	public $urlparam = 'page';
	public $XMLname = 'page';
	public $fileType = 'page';
	
	public $whatFileBase = '../data/pages.xml';
	
	public $buttonText = 'Save Page';

	
	public $necessaryFields = array(
		array('title', 'text', 'Title:', 'Title'),
		array('content', 'mdtextarea', 'Page Content:', 'Page Content'),
		array('moreoptions', 'heading', 'More Options', 'More Options'),
		array('slug', 'text', 'URL Slug: ', 'URL Slug'),
		array('template', 'templateDropdown', 'Page Template: ', 'Page Template')
	);
	
	//addscript.php variables
	public $XMLfile = '../../data/pages.xml';
	public $entryName = 'page';
	
	public $toSave = array('title','content','date','slug', 'template');
}

class TypePost extends Type {
	
	
	public $urlparam = 'post';
	public $XMLname = 'post';
	public $fileType = 'single';
	
	public $whatFileBase = '../data/posts.xml';
	
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
	
	//addscript.php variables
	public $XMLfile = '../../data/posts.xml';
	public $entryName = 'post';
	
	public $toSave = array('title','content','date','categories','excerpt','slug', 'template');
}

class TypeCategory extends Type {
	
	
	public $urlparam = 'category';
	public $XMLname = 'category';
	public $fileType = 'category';
	
	public $whatFileBase = '../data/categories.xml';
	
	
	
	public $buttonText = 'Save Category';

	
	public $necessaryFields = array(
		array('title', 'text', 'Title:', 'Title'),
		array('description', 'textarea', 'Description:', 'Description'),
		array('moreoptions', 'heading', 'More Options', 'More Options'),
		array('slug', 'text', 'URL Slug: ', 'URL Slug'),
	);
	
	//addscript.php variables
	public $XMLfile = '../../data/categories.xml';
	public $entryName = 'category';
	
	public $toSave = array('title','description','slug');
	
}



























?>