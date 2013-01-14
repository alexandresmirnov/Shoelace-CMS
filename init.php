<?php 


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
		$cat = $_GET['category'];
		
		$postsSearch = $postsFile->xpath("//post[contains(categories, '".$cat."')]");
		$posts = array_reverse($postsSearch);
		
		//the total amount of posts
		$howManyPosts = count($posts);
		
		$posts = array_slice($posts, $whereToStart , $postsPerPage);
		
	}
	
	
	
	//Single post view
	if (isset($_GET['post'])) {
	
		$thePost = $_GET['post'];
		
		$postSearch = $postsFile->xpath("//post[contains(slug, '$thePost')]");

		$post=$postSearch[0];

		$postTemplate = $post->postTemplate;
	
	}

	/*
	$postSlugs = array(
		//post ID => post
	);



	foreach(shoelaceinfo('posts') as $post){


	$postSlug = $post->slug;

	$postSlugs["".$postSlug] = $post;

	}

	$post=$postSlugs[$thePost];
	*/

	
	
	
	
	

	

	
	
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
		case 'query':
			return $query;
			break;
		case 'searchResults':
			return $searchResults;
			break;
		case 'theme':
			return $theme;
			break;
		case 'themedir':
			return $themedir;
			break;
		case 'rootdir':
			return $rootdir;
			break;
		case 'themeDirectory':
			return $themeDirectory;
			break;
		case 'siteName':
			return $siteName;
			break;
	}
	
	

}

/*
echo shoelaceinfo('page');
echo shoelaceinfo('whereToStart');
echo shoelaceinfo('upToWhere');
echo " ";
echo shoelaceinfo('howManyPosts');
echo shoelaceinfo('postsPerPage');
*/


function listCategories($post, $before = "<li>", $after = "</li>"){
	
	
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

			echo $before."<a href=\"".shoelaceinfo('rootdir')."/category.php"."?".$newURL."\">".$category."</a>".$after;

		}

	}

}

function previousPageLink($link = "&laquo;", $before = "<li>", $after="</li>"){

	$newGET = array();

	if(shoelaceinfo('whereToStart')>0){
	
		$newGET = $_GET;
		
		$newGET['page'] = shoelaceinfo('previousPage');
		$newURL = http_build_query($newGET);
		echo $before."<a href=\"".$_SERVER['PHP_SELF']."?".$newURL."\">".$link."</a>".$after;
		
	}

};

function nextPageLink($link = "&raquo;", $before = "<li>", $after="</li>"){

	$newGET = array();

	if(shoelaceinfo('upToWhere')<shoelaceinfo('howManyPosts')){
	
		$newGET = $_GET;
		
		$newGET['page'] = shoelaceinfo('nextPage');
		$newURL = http_build_query($newGET);
		
		echo $before."<a href=\"".$_SERVER['PHP_SELF']."?".$newURL."\">".$link."</a>".$after;
		
	}

};

function pageLinks($displayIfOnePage = true, $before = "<li>", $after = "</li>"){

	
	
	$newGET = array();

	$howManyPages = shoelaceinfo('howManyPosts')/shoelaceinfo('postsPerPage');
	$howManyPages = ceil($howManyPages);

	for($i=1; $i <= $howManyPages; $i++){
	
		$newGET = $_GET;
		$newGET['page'] = $i;
		$newURL = http_build_query($newGET);

		if($displayIfOnePage==false && $howManyPages==1){
		
		}
		else {
		
		if($i==1){
			echo $before."<a href=\"".$_SERVER['PHP_SELF']."\">".$i."</a>".$after;

		}
		else {
			echo $before."<a href=\"".$_SERVER['PHP_SELF']."?".$newURL."\">".$i."</a>".$after;
		}
		
		}
	}

}



?>