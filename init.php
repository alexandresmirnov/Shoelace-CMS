<?php 

/*
function shoelaceinfo($whatvar){

	$settings = simplexml_load_file('data/settings.xml');

	$rootdir = $settings->installDir;


	$theme = $settings->theme;
	$themedir = 'themes/'.$theme;
	$siteName = $settings->siteName;

	$themeDirectory = $rootdir."/".$themedir;

	require_once 'markdown.php';

	$postsPerPage = $settings->postsPerPage;

	$postsFile = simplexml_load_file('data/posts.xml');
	$posts = (array) $postsFile;
	$posts = array_reverse($posts["post"]);

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	else {
		$page = 1;
	}

	$nextPage = $page+1;
	$previousPage = $page-1;
	
	$currentType = 'home';
	
	
	$urlparam = '';
	

	//number of first post on the page
	$whereToStart = $postsPerPage*($page-1);
	
	//number of last post on the page
	$upToWhere = $postsPerPage*$page;

	$query = '';
	
	
	
		
		//the total amount of posts
		$howManyPosts = count($posts);
		
		$howManyPages = $howManyPosts/$postsPerPage;
	$howManyPages = ceil($howManyPages);
		
		//the array that represents posts
		$posts = array_slice($posts, $whereToStart , $postsPerPage);
	
	//If a search query is entered
	if (isset($_GET['query'])) {
	
		$currentType = 'search';
		
		$query = $_GET['query'];
		
		$query = strtolower($query);
		
		$postsSearch = $postsFile->xpath("//post[contains(translate(content, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '".$query."')] |// //post[contains(translate(title, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '".$query."')]");
		$searchResults = array_reverse($postsSearch);
		
		//the total amount of posts
		$howManyPosts = count($searchResults);
		
		$posts = array_slice($searchResults, $whereToStart , $postsPerPage);
		
		
	}
	
	//If a category is active
	if (isset($_GET['category'])) {
	
		$currentType = 'category';
		
		$cat = $_GET['category'];
		
		$postsSearch = $postsFile->xpath("//post[contains(categories, '".$cat."')]");
		$posts = array_reverse($postsSearch);
		
		//the total amount of posts
		$howManyPosts = count($posts);
		
		$posts = array_slice($posts, $whereToStart , $postsPerPage);
		
	}
	
	
	
	//Single post view
	if (isset($_GET['post'])) {
	
		$currentType = 'single';
	
		$thePost = $_GET['post'];
		
		$postSearch = $postsFile->xpath("//post[contains(slug, '$thePost')]");

		$post=$postSearch[0];

		$postTemplate = $post->template;
	
	}
	
	$pagesFile = simplexml_load_file('data/pages.xml');

	if (isset($_GET['pageSlug'])) {
		
		$currentType = 'page';
	
		$thePage = $_GET['pageSlug'];
		$pageSearch = $pagesFile->xpath("//page[contains(slug, '$thePage')]");

		
		if(count($pageSearch)==0){
		
			header( 'Location: '.$rootdir.'/404.php' );
		
		}
		
		
		
		$page = $pageSearch[0];
		
		$pageTemplate = $page->template;
	}

	
	
	
	
	
	

	

	
	
	switch ($whatvar) {
		case 'postsPerPage':
			return $postsPerPage;
			break;
		case 'page':
			return $page;
			break;
		case 'nextPage':
			return $nextPage;
			break;
		case 'previousPage':
			return $previousPage;
			break;
		case 'whereToStart':
			return $whereToStart;
			break;
		case 'upToWhere':
			return $upToWhere;
			break;
		case 'howManyPosts':
			return $howManyPosts;
			break;
		case 'howManyPages':
			return $howManyPages;
			break;
		case 'posts':
			return $posts;
			break;
		case 'postsFile':
			return $postsFile;
			break;
		case 'postTemplate':
			return $postTemplate;
			break;
		case 'post':
			return $post;
			break;
		case 'pagesFile':
			return $pagesFile;
			break;
		case 'pageTemplate':
			return $pageTemplate;
			break;
		case 'page':
			return $page;
			break;
		case 'query':
			return $query;
			break;
		case 'searchResults':
			return $searchResults;
			break;
		case 'theme':
			return $theme;
			break;
		case 'themeDir':
			return $themedir;
			break;
		case 'rootDir':
			return $rootdir;
			break;
		case 'themeDirectory':
			return $themeDirectory;
			break;
		case 'siteName':
			return $siteName;
			break;
		case 'currentType':
			return $currentType;
			break;
	}
	
	

}

*/

require_once 'markdown.php';


class Shoelace {

	public function __construct(){
	
		$settings = simplexml_load_file('data/settings.xml');

	
		foreach($settings->children() as $child){
		
			$childName = $child->getName();
			
			$this->$childName = $child;
			
		}
		
		$this->themeDir = 'themes/'.$this->theme;
	
		$this->themeDirectory = $this->installDir."/".$this->themeDir;
	
		$this->rootDir = $this->installDir;
	
		$this->pagesFile = simplexml_load_file('data/pages.xml');
	
		$this->postsFile = simplexml_load_file('data/posts.xml');
		$this->posts = (array) $this->postsFile;
		$this->posts = array_reverse($this->posts["post"]);
	
		if (isset($_GET['page'])) {
			$this->page = $_GET['page'];
		}
		else {
			$this->page = 1;
		}
		
		$this->nextPage = $this->page+1;
		$this->previousPage = $this->page-1;
	
		$this->currentType = 'home';
		$this->urlparam = '';
		
		$this->whereToStart = $this->postsPerPage*($this->page-1);
		$this->upToWhere = $this->postsPerPage*$this->page;
		
		$this->query = '';
		
		$this->howManyPosts = count($this->posts);
		
		$this->howManyPages = $this->howManyPosts/$this->postsPerPage;
		$this->howManyPages = ceil($this->howManyPages);

		$this->posts = array_slice($this->posts, $this->whereToStart, $this->postsPerPage);
		
		if (isset($_GET['query'])) {
	
			$this->currentType = 'search';
			
			$this->query = $_GET['query'];
			
			$this->query = strtolower($this->query);
			
			$this->postsSearch = $this->postsFile->xpath("//post[contains(translate(content, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '".$this->query."')] |// //post[contains(translate(title, 'ABCDEFGHJIKLMNOPQRSTUVWXYZ', 'abcdefghjiklmnopqrstuvwxyz'), '".$this->query."')]");
			$this->searchResults = array_reverse($this->postsSearch);
			
			$this->howManyPosts = count($this->searchResults);
			
			$this->posts = array_slice($this->searchResults, $this->whereToStart , $this->postsPerPage);
			
		}
		
		if (isset($_GET['category'])) {
	
			$this->currentType = 'category';
			
			$this->cat = $_GET['category'];
			
			$this->postsSearch = $this->postsFile->xpath("//post[contains(categories, '".$this->cat."')]");
			$this->posts = array_reverse($this->postsSearch);
			
			//the total amount of posts
			$this->howManyPosts = count($this->posts);
			
			$this->posts = array_slice($this->posts, $this->whereToStart , $this->postsPerPage);
			
		}
		
		if (isset($_GET['post'])) {
	
			$this->currentType = 'single';
		
			$this->thePost = $_GET['post'];
			
			$this->postSearch = $this->postsFile->xpath("//post[contains(slug, '$this->thePost')]");

			$this->post=$this->postSearch[0];

			$this->postTemplate = $this->post->template;
		
		}
		
		if (isset($_GET['pageSlug'])) {
		
			$this->currentType = 'page';
		
			$this->thePage = $_GET['pageSlug'];
			$this->pageSearch = $this->pagesFile->xpath("//page[contains(slug, '$this->thePage')]");

			
			if(count($this->pageSearch)==0){
			
				header( 'Location: '.$this->rootDir.'/404.php' );
			
			}
			
			
			
			$this->page = $this->pageSearch[0];
			
			$this->pageTemplate = $this->page->template;
		}
		
	}
		
		
		public function listCategories($post, $before = "<li>", $after = "</li>"){
	
	
	/*
	echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'].'<br>';
	echo $_SERVER['REQUEST_URI'];
	*/
	
	$newGET = array();
	
	
	
	$categories = $post->categories->category;

	if(isset($categories)){

		foreach($categories as $category){
			$category = (string) $category;
			$newGET['category'] = $category;
			$newURL = http_build_query($newGET);

			echo $before."<a href=\"".$this->rootDir."/category/".$category."\">".$category."</a>".$after;

		}

	}

}

public function previousPageLink($link = "&laquo;", $before = "<li>", $after="</li>"){

	$newGET = array();
	
	$currentDir = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME']));
	
	if($this->whereToStart>0){
	
		$newGET = $_GET;
		
		$newGET['page'] = $this->previousPage;
		$newURL = http_build_query($newGET);
		
		if($this->previousPage==1){
			echo $before."<a href=\"".$currentDir."\">".$link."</a>".$after;
		}
		else{
			echo $before."<a href=\"".$currentDir."/page/".$this->previousPage."\">".$link."</a>".$after;
		}
		
		
	}

}

public function nextPageLink($link = "&raquo;", $before = "<li>", $after="</li>"){

	$newGET = array();
	
	$currentDir = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME']));

	if($this->upToWhere<$this->howManyPosts){
	
		$newGET = $_GET;
		
		$newGET['page'] = $this->nextPage;
		$newURL = http_build_query($newGET);
		
		echo $before."<a href=\"".$currentDir."/page/".$this->nextPage."\">".$link."</a>".$after;
		
	}

}

public function pageLinks($displayIfOnePage = true, $before = "<li>", $after = "</li>"){

	
	
	$newGET = array();

	$howManyPages = $this->howManyPosts/$this->postsPerPage;
	$howManyPages = ceil($howManyPages);

	for($i=1; $i <= $howManyPages; $i++){
	
		$newGET = $_GET;
		$newGET['page'] = $i;
		$newURL = http_build_query($newGET);

		$currentDir = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME']));
		
		
		if($displayIfOnePage==false && $howManyPages==1){
		
		}
		else {
		
			if($i==1){
				echo $before."<a href=\"".$currentDir."\">".$i."</a>".$after;

			}
			else {
				echo $before."<a href=\"".$currentDir."/page/".$i."\">".$i."</a>".$after;
			}
		
		}
	}

}
		
		
		
	
	
	
	//public $themeDirectory = $this->installDir;

	
	
	public $typeList;
	
}

$shoelace = new Shoelace;




/*
echo shoelace('page');
echo shoelace('whereToStart');
echo shoelace('upToWhere');
echo " ";
echo shoelace('howManyPosts');
echo shoelace('postsPerPage');
*/






?>