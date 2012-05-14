<info>
title: Using mod_rewrite to create friendlier URLs
author: callumacrae
date: 1294898400
tags: php, seo, mod_rewrite
summary: mod_rewrite is an Apache module used for rewriting a URL at the server level, making the URL a lot friendlier. For example, if a user goes to example.com/article/421 they will in fact be shown example.com/article.php?id=421, but they still think they're accessing /article/421.
</info>

mod\_rewrite is an Apache module used for rewriting a URL at the server level, making the URL a lot friendlier. For example, if a user goes to example.com/article/421 they will in fact be shown example.com/article.php?id=421, but they still think they're accessing /article/421. This is a different to redirect, as a redirect completely changes the page the user is on, telling them that they're on article.php, but mod\_rewrite does not - this makes the URL look a lot friendlier, while not requiring millions of pages.

## Where is it already used?

Many (if not most) PHP sites use mod\_rewrite, such as:

* facebook.com
* twitter.com
* Most URL shortners
* Wikipedia
* Most news sites
* The list could go on forever.

Also, more than a few scripts use mod\_rewrite, including (among others), WordPress, Joomla, Drupal, MediaWiki and most CMS platforms.


## Using mod_rewrite

To use mod\_rewrite, you simply have to have the mod_rewrite installed (and enabled) on your Apache server. To see whether you have mod\_rewrite enabled, create a PHP info file and search for "mod\_rewrite". If it is installed, it should appear into the "Apache loaded modules" section.


## A very simple example

This example will simply display bar.html where foo.html is requested. Firstly, we need to create the foo.html and bar.html files. Technically we don't actually have to create foo.html because the server will just ignore it, but I am putting it there anyway so we can easily tell if it doesn't work. Unless you are confident with mod\_rewrite, I would always recommend creating that file. Obviously, when we move onto more complicated examples, you can't create every file.

Create foo.html with the following:

	<b>Error:</b> mod_rewrite seems to have failed.

bar.html:

	<h1>Welcome!</h1>
	<p>The mod_rewrite is successfully working!</p>

The, add the following lines to your .htaccess file:

	RewriteEngine On
	RewriteRule ^foo.html$ bar.html

Make sure that the .htaccess is in the same directory as the html files, the open foo.html. You should see the message saying that the rewrite worked. If it didn't, check the following:

* The .htaccess is in the same directory as the html files
* You're not opening foo.html directly, you're opening it through a web server
* You have the mod\_rewrite module enabled
* Browser cache is disabled

If it still isn't working, feel free to ask in a comment and someone (probably me) will reply as soon as they can.

## How did it work, though?

The structure of a RewriteRule is as follows:

	RewriteRule pattern replacement [flags]

`RewriteRule` - the name of the command, lets Apache know that we want to rewrite something.

`pattern` - regex pattern which will be applied to the URL that has just been requested.

`replacement` - If the pattern returns true, the file specified as the replacement is requested instead. As it is regex, you can include backreferences, which should be written as $n

`[flags]` - flags are optional. They should be surrounded by square brackets and separated by a comma. Here are a list of the most comment flags:

* **F** - Forbidden. Returns a 403 error.
* **L** - Last rule. If this succeeds, no other rules will be attempted.

A full list is available on the apache website.


## A more complex example

In this example, we are going to redirect people requesting article/124/ to article.php?id=124. You do not need the /article/ directory to exist, but article.php must obviously exist, or you will get a 404 error. Put the following code in article.php:

	<?php
	if (isset($_REQUEST['id']) && is_int($_REQUEST['id'])) {
		echo 'You requested article ' . $_REQUEST['id'];
	}

Then, add the following couple of lines to your .htaccess file:

	RewriteEngine On
	RewriteRule ^article/([^/\.]+)/?$ article.php?id=$1 [L]

Accessing /article/124 should now display:

	You requested article 124


## How does it work?

Lets work through the rule, seeing exactly what everything does.

* `^article/` - sees whether the requested page begins with article/
* `[^/\.]+)` - standard regex, means it checks for one or more characters that ar not / or ., and then saves it as a backlist.
* `/?$` - optional / at the end of the pattern
* `article.php?id=$1` - the page that will be loaded if the pattern returns true, with $7 being replaced by the contents of `([^/\.]+)`
* `[L]` - Tells Apache not to test any more rules if this one succeeds

If you wanted to make it more secure, you could replace `([^/\.]+)` with something which makes sure the characters are numbers. This adds some extra security against injections, but does not display a nice error; just a 404 error. You could replace `([^\/.]+)` with `([0-9]+)`, which simply checks for one or more integer between 0 and 9, and saves it as a backlist.

If you still wanted a friendly error, you can use:

	RewriteEngine On
	RewriteRule ^article/([0-9]+)/?$ article.php?id=$1 [L]
	RewriteRule ^article/.+/?$ hackattempt.html [L]

Because of the `[L]` flag, any value that is requested from the article directory that is a number will return true to the first rule, meaning the second rule won't be tested. If it is not a number but is still requested from that directory, they will be send hackattempt.html

<br>

That's all - I hope this article has helped, feel free to share where you have used it and how it has helped.
