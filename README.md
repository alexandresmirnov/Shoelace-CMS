Shoelace CMS is a PHP CMS that uses XML to store data.  It uses Markdown to write the posts.

At the moment, it has:
* Posts
* Pages
* Categories
* Themes
* Login/Authentication
* Search

Here's how it works - when a user accesses the index.php file (or just "/"), Shoelace finds what the currently active theme is by using settings.xml.  It then goes into the directory of that theme, and includes the theme's index.php file.  Before including it, it includes the "init-posts.php" file, which contains the code that actually powers the front-end.  It initializes some variables and some functions which are all demonstrated in the default theme.

The same thing happens for every other php file - when a user accesses a page, the "init-page.php" file is included, after which the theme's "page.php" file is included.