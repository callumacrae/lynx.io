<info>
title: PHP AJAX Best Practices
author: callumacrae
date: %date%
tags: php, ajax, best practices, xhr, json, xml
summary: As the use of AJAX becomes more and more popular, it becomes increasingly important that when responding to AJAX requests in PHP, there are some best practices that you should stick to in order to make dealing with the response at the other end a lot easier. In this article, I will cover the more important best practices, and explain how they are relevant and how you can do them.
</info>

As the use of AJAX becomes more and more popular, it becomes increasingly important that when responding to AJAX requests in PHP, there are some best practices that you should stick to in order to make dealing with the response at the other end a lot easier. In this article, I will cover the more important best practices, and explain how they are relevant and how you can do them.

Before I start explaining the best practices, I'll provide an `is_ajax()` function which I will use throughout this article. I use this function or a variation upon it in most of my projects, too.

	function is_ajax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
	}


## Respond with JSON or XML, not HTML

Responding to AJAX requests with HTML is a thing of the past. Previously, it was common to render the entire page server-side, and then send it as HTML, replacing the old HTML with the new HTML. For example, we would have had this for a two page website:

index.php:

	<?php
		include('functions.php'); // Contains is_ajax
		
		$page = $_GET['page'];
		if (empty($page) || !preg_match('/^[a-z]+$/', $page)) {
			$page = 'index';
		}
		
		if (is_ajax()) {
			include "pages/$page.html";
			exit;
		}
	?>
	<html>
	<head>
		<title>Website using AJAX!</title>
		<script src="js/jquery.min.js"></script>
		<script>
			// Capture all local URLs
			$(document).on('click', 'a:not([href^="http"])', function (e) {
				e.preventDefault();
				
				$.get($(this).attr('href'), function (html) {
					$('body').html(html);
				});
			});
		</script>
	</head>
	<body>
		<?php include "pages/$page.html"; ?>
	</body>
	</html>

pages/index.html:

	<h1>Page one!</h1>
	
	<p>This is the first page. It contains a link to the second page:</p>
	
	<a href="?page=spam">Spam page</a>

pages/spam.html

	<h1>Spam page</h1>
	
	<p>spamspamspamspamspamspamspam</p>


While that does work, it is sending HTML as a response to an AJAX request, and so should not be used. Instead, you should respond with one of the following two code samples, and replace each element manually from that. With larger pages, you could use a templating engine.

JSON:

	{
		"title": Spam page",
		"text": "spamspamspamspamspamspamspam"
	}

Or XML:

	<?xml version="1.0"?>
	<page>
		<title>Spam page</title>
		<text>spamspamspamspamspamspamspam</text>
	</page>

That page also does a lot of other things wrong, and I will be visiting it again throughout the article.

When thinking about whether to offer JSON or XML, you could also consider the possibility of offering both, and checking the Accept header to see what the user wants:

	if ($_SERVER['HTTP_ACCEPT'] === 'application/json') {
		echo json_encode($data);
	} else {
		function xml_encode($data, $title) {
			// Magic here
		}

		echo xml_encode($data, 'page');
	}


## Check the header, not the URL

When offering both JSON and XML to the user (and any other formats), there are a number of ways you can use the determine whether the user wants JSON or XML.

First, there is the Accept header. The Accept header basically tells the server the content type of the data it wants back: for JSON, `application/json`, and for XML, `text/xml`.

Another popular method is to have "json" or "xml" somewhere in the URL. For example, take these URLs:

	http://example.com/json/index/list
	http://example.com/index/list.json
	http://example.com/index/list/json

They all have "json" in the URL, so that the server knows to respond with JSON. However, what if the URL has "xml" in the URL and the Accept header is set to `application/json`? We would have to decide what takes priority.

Both methods are fairly easy to work with and both are possible to specify. It is slightly easier to add "json" to the URL than specify the Accept header, but I haven't managed to find a client that doesn't let me specify it yet.

The best way to determine whether the user wants JSON or XML is to use the Accept header, not the URL. It can be confusing using the URL too, so for that reason you should not use the URL to determine it at all.


## Set the Content-type header when replying with JSON or XML

When replying with JSON or XML, it is important that you tell the browser what you're replying with. Besides the obvious reason that now the browser knows what you're replying with, this has a few more advantages:

- **Your browser's inspector will show you the data in a more readable form.** I use Chrome, so I will explain this in terms of the WebKit inspector, although I am sure that it is fairly easy in Firebug and the Opera development tools, too. In the "network" tab, clicking on an AJAX request where the Content-type header has been set to `application/json` and clicking on the "repsonse" tab will show you the parsed object which you can then click through, not just the JSON string.
- **jQuery and other AJAX libraries know what to do with the data.** If a request sent using `$.ajax` (or `$.get` or `$.post`) responds with data with a Content-type of `application/json`, then it automatically parsed the JSON and gives you the parsed data in the callback instead of the body. This is pretty helpful, as it means that you don't have to do it manually every time.

You can set the content type like this in PHP:

	header('Content-type: application/json');
	
	// Or:
	
	header('Content-type: text/xml');


## Seperate AJAX code from non-AJAX code

In the code at the top of the page, you can see that the AJAX and non-AJAX code are on the same page:

	<?php
		include('functions.php'); // Contains is_ajax
		
		$page = $_GET['page'];
		if (empty($page) || !preg_match('/^[a-z]+$/', $page)) {
			$page = 'index';
		}
		
		if (is_ajax()) {
			include "pages/$page.html";
			exit;
		}
	?>
	<html>
	<head>

That's bad practice, as it makes the code tricky to find and even trickier to maintain. For a start, you should be seperating the view from the logic using something like the MVC architecture. I'm going to explain the next bit in terms of MVC, but it should be fairly easy to apply to anything else.

The code that deals with AJAX requests should be completely seperate to the code that deals with non-AJAX requests. You could have seperate functions in your controller:

	<?php
	
	class Posts extends \App\Controller {
		/**
		 * List posts, return HTML
		 */
		public function list() {
			// Do stuff
		}
		
		/**
		 * List posts, return JSON or XML
		 */
		public function list_ajax() {
			// Do stuff
			
			// $this->render detects whether JSON or XML and sets header and
			// outputs correct correct format.
			echo $this->render($data);
		}
	}

Both are accessed at `/posts/list`, but the first is called if `is_ajax()` returns false, and the second if it returns true. It is a lot more readable and clear than just having an if statement in the `list` method.

Another approach would be to have entirely different controllers. Say that our existing controller is in `controllers/posts.php`: we could have the AJAX controller in `controllers/posts_ajax.php` or in `controllers_ajax/posts.php` (depends on how seperate you want them). Another advantage of having different controllers is that you don't have to load AJAX functionality (such as `->render()`) on the non-AJAX controller, and you don't have to load non-AJAX functionality (such as views) on the AJAX controller.


## Check all output

I have in the past seen code like this:

	$posts = $db->query('SELECT * FROM posts');
	echo json_encode($posts->fetchAll());

That code is pretty bad. While there might not be anything sensitive in the posts table, you're probably sending a lot of useless information. And if another developer adds some sensitive information (say, IP address) to the posts table at some point in the future, how should he know that you're being lazy and outputting the entire table?

Instead of doing it like in the code above, you should do it like this:

	$posts = $db->query('SELECT * FROM posts');
	$postsArray = array();
	while ($post = $posts->fetchObject()) {
			$postsArray[] = array(
				'subject'	=> $post->subject,
				'author'	=> $post->author,
				'text'		=> $post->text,
			);
	}
	
	echo json_encode($postsArray);

With that code, you could also do further useful stuff such as getting all of the authors information and putting it into the array:

	$postsArray[] = array(
		'subject'	=> $post->subject,
		'author'	=> $users->getInfo($post->author),
		'text'		=> $post->text,
	);


## Make replies as small as possible

Besides taking the steps mentioned in the previous point to reduce the size of responses, you should also take other steps to make replies small. If replies are too big, then you could get a fairly big delay between clicking a button and something happening - obviously, you don't want this. Users on slow connections will just leave your website.

There are a few things that you can do to make your replies smaller:

- Don't send HTML, send JSON or XML objects
- Don't send information that isn't needed, such as entire tables
- Send only the requested information - if they only requested 10 posts, don't send the entire table
- Use JSON over XML. Especially if you have a lot of arrays (JavaScript arrays, or PHP arrays without keys), XML can be a lot bigger that JSON.
- Minify the JSON or XML, reducing the amount of needless whitespace. Humans won't be reading this data!


## Don't send requests too often

My final point isn't really a PHP point, but is important nonetheless. It is extremely important that you don't send AJAX requests too often - if you do, you'll increase the load on your server and your site could become very slow or go down completely. I generally stick to one request every three seconds maximum, and often I'll use a lot longer than that (this site checks for new comments every 15 seconds).