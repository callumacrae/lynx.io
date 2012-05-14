<info>
title: Ultimate Guide to .htaccess
author: callumacrae
date: 1293865263
tags: Apache, blocking, error documents, htaccess, redirect
summary: The .htaccess file is a text file that contains Apache directives. Any directives you place in it will apply to the directory that contains the htaccess and also any directories below it. htaccess is extremely powerful, and has many functions. Some of the main functions include custom error pages, password protection of directories and files, rewriting of URLs, and more, and in this article I will explain how to use htaccess.
</info>

The .htaccess file is a text file that contains Apache directives. Any directives you place in it will apply to the directory that contains the .htaccess and also any directories below it. htaccess is extremely powerful, and has many functions. Some of the main functions include custom error pages, password protection of directories and files, rewriting of URLs, and more. The htaccess is simple a plain text file of the sort that can be created and edited using any text editor such as Notepad++ or Vim. The reason it is called .htaccess is because htaccess is short for "hypertext access", and the . simply means it is a hidden file on UNIX systems, meaning it won't be sent over the internet if someone requests it.

htaccess files should be uploaded in ASCII mode, and have permissions set to 0644 (RW-R--R--). This makes the file readable by the server, but not by the users of your website, as that would be (as you can imagine) a major security risk.

htaccess is Apache only, but some servers may have it disabled - check with your hosting provider.

The great thing about htaccess is its simplicity; even if some commands seem complicated at first, when you have learned them you will find them easy to use. Also, htaccess is extremely well-documented, both on the Apache website and all over the internet. If you are unsure about something, a simple search will return countless results.

## Error Documents
Error documents seem to be the most common use of the htaccess. It is certainly one of the most useful, and some people seem to think that error documents are the only thing the htaccess file does!

The most common errors:

* **400** - Bad request
* **401** - Authorisation required
* **403** - Forbidden
* **404** - File not found
* **500** - Internet server error

You can find a complete list of all errors [here](http://en.wikipedia.org/wiki/List_of_HTTP_status_codes).

The ErrorDocument command uses the following syntax:

	ErrorDocument code file

So for a 404 error:

	ErrorDocument 404 /errors/notfound.html

NOTE: This will go from the root directory, not the current directory. To go from the current directory, remove the starting / .

You can name the pages anything you want and put them anywhere you like. You can also use HTML:

	ErrorDocument 404 "<strong>404 error:</strong> The page you requested was not found"


## Password protecting a directory or file

htaccess allows you to to password protect an area of your site. Although I would recommend using a PHP script to do this (article coming soon), you can still do it via htaccess if you wish. And I am going to show you how:

Create a file called .htpasswd and use the following syntax for username and passwords:

	testuser: password
	anotheruser: diffpass

The password must be encrypted. You can use [this tool](http://www.tools.dynamicdrive.com/password/) to encrypt the passwords for you.

For security reasons (you don't want people to be able to view the passwords), you should place the htpasswd file above the web root.

Once you've created the .htpasswd file, add this to your .htaccess:

	AuthUserFile /path/to/your/.htpasswd
	AuthGroupFile /dev/null
	AuthName ProtectedDir
	AuthType Basic

	require user testuser

Let's break that down a bit.

	AuthUserFile /path/to/your/.htpasswd

This line tells Apache the server path of you htpasswd file.

	AuthGroupFile /dev/null

We don't want a group file

	AuthName ProtectedDir

The name of the area you want protecting - it can be set to pretty much anything.

	AuthType Basic

The type of authorisation we're going to use. You shouldn't need to change this; we're using basic HTTP authentication.

	require user testuser

This is the username of the user we want to grant access to the area to. If you want all users to have access, use:

	require valid-user

To password protect one file, use this:

	<files file.txt>
	AuthUserFile /path/to/your/.htpasswd
	AuthGroupFile /dev/null
	AuthName ProtectedDir
	AuthType Basic

	require user testuser
	</files>

The files tag specifies that the enclosed commands should only be applied to the specified files.


## Rewriting URLs

This section is so big that I decided it was worth an entire article to itself - coming in the next couple days.

## Blocking people (or robots)

You can easily block people from accessing your website using htaccess. It's probably the quickest, easiest way of blocking them.

### Blocking by IP

To block by IP, add the following lines to your htaccess:

	order allow, deny
	deny from 01.234.567.89
	allow from all

This will block the IP 01.234.567.89. You can also block a range of IPs (say, a whole country or ISP):

	order allow, deny
	deny from ^01.
	allow from all

That will block all IPs beginning with 01. (yes, we can use regex too!)

### Using a whitelist

The following code will allow connections from 01.234.567.89 and <strong>only</strong> 01.234.567.89. Again, you can block ranges of IPs and use regex.

	order deny, allow
	allow from 01.234.567.89
	deny from all

### Block by referrer

You might want to block by referrer, for example, if a site is hotlinking a couple images or you simply don't want someone linking to you.

	RewriteEngine On
	RewriteCond %{HTTP_REFERER} badsite\.com [NC,OR]
	RewriteCond %{HTTP_REFERER} badsite2\.com
	RewriteRule .* - [F]

That seems slightly complex at first. Let's break it down a bit:

	RewriteEngine On

If you don't know what this is, you may want to read my article on mod\_rewrite. If you can't be bothered or just want to know without reading a massive article, it turns mod\_rewrite on. If you haven't a clue what that means, I would recommend reading my article (unless you don't actually want to block by referrer - it's not that commonly used anyway)

	RewriteCond %{HTTP_REFERER} badsite\.com [NC,OR]
	RewriteCond %{HTTP_REFERER} badsite2\.com

Tells the rewrite engine that badsite.com and badsite2.com should be rewritten. If you only want to specify one website, use the following code instead:

	RewriteCond %{HTTP_REFERER} badsite\.com [NC]

Onto the next section of code:

	RewriteRule .* - [F]

Tells the rewrite engine that any file name matching .* (wildcard!) should be given a 403 forbidden error. This code will only work if any of the above RewriteCond's have succeeded (if their referrer is matching one of those URLs).

### Blocking bad bots

Thanks to <a href="http://www.askapache.com/htaccess/blocking-bad-bots-and-scrapers-with-htaccess.html">askapache.com</a> for this code:

	RewriteEngine On

	# IF THE UA STARTS WITH THESE
	RewriteCond %{HTTP_USER_AGENT} ^(aesop_com_spiderman|alexibot|backweb|bandit|batchftp|bigfoot) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(black.?hole|blackwidow|blowfish|botalot|buddy|builtbottough|bullseye) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(cheesebot|cherrypicker|chinaclaw|collector|copier|copyrightcheck) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(cosmos|crescent|curl|custo|da|diibot|disco|dittospyder|dragonfly) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(drip|easydl|ebingbong|ecatch|eirgrabber|emailcollector|emailsiphon) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(emailwolf|erocrawler|exabot|eyenetie|filehound|flashget|flunky) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(frontpage|getright|getweb|go.?zilla|go-ahead-got-it|gotit|grabnet) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(grafula|harvest|hloader|hmview|httplib|httrack|humanlinks|ilsebot) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(infonavirobot|infotekies|intelliseek|interget|iria|jennybot|jetcar) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(joc|justview|jyxobot|kenjin|keyword|larbin|leechftp|lexibot|lftp|libweb) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(likse|linkscan|linkwalker|lnspiderguy|lwp|magnet|mag-net|markwatch) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(mata.?hari|memo|microsoft.?url|midown.?tool|miixpc|mirror|missigua) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(mister.?pix|moget|mozilla.?newt|nameprotect|navroad|backdoorbot|nearsite) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(net.?vampire|netants|netcraft|netmechanic|netspider|nextgensearchbot) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(attach|nicerspro|nimblecrawler|npbot|octopus|offline.?explorer) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(offline.?navigator|openfind|outfoxbot|pagegrabber|papa|pavuk) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(pcbrowser|php.?version.?tracker|pockey|propowerbot|prowebwalker) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(psbot|pump|queryn|recorder|realdownload|reaper|reget|true_robot) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(repomonkey|rma|internetseer|sitesnagger|siphon|slysearch|smartdownload) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(snake|snapbot|snoopy|sogou|spacebison|spankbot|spanner|sqworm|superbot) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(superhttp|surfbot|asterias|suzuran|szukacz|takeout|teleport) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(telesoft|the.?intraformant|thenomad|tighttwatbot|titan|urldispatcher) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(turingos|turnitinbot|urly.?warning|vacuum|vci|voideye|whacker) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} ^(libwww-perl|widow|wisenutbot|wwwoffle|xaldon|xenu|zeus|zyborg|anonymouse) [NC,OR]

	# STARTS WITH WEB
	RewriteCond %{HTTP_USER_AGENT} ^web(zip|emaile|enhancer|fetch|go.?is|auto|bandit|clip|copier|master|reaper|sauger|site.?quester|whack) [NC,OR]

	# ANYWHERE IN UA -- GREEDY REGEX
	RewriteCond %{HTTP_USER_AGENT} ^.*(craftbot|download|extract|stripper|sucker|ninja|clshttp|webspider|leacher|collector|grabber|webpictures).*$ [NC]

	# ISSUE 403 / SERVE ERRORDOCUMENT
	RewriteRule . - [F,L]

This returns a 403 error for any user agent  in the list. You could also use similar code to block IE users from accessing your site. I wouldn't recommend it though!

Obviously this method isn't 100% guarenteed to stop the bad bots - it isn't a full list and they can change their user agent anyway.


## Change default directory page

DirectoryIndex is a command that allows you to specify the default file to be loaded when a directory is requested, but a specific file isn't. For example, requesting example.com could actually give you example.com/index.html.

The command works like this:

	DirectoryIndex filename.html filename.php

That would cause file.html to be loaded by default if no file was specified, but if the server can't find it, it loads filename.php instead. This is what I usually use on my websites:

	DirectoryIndex index.html index.php /error/noindex.html

## Redirects

There are many ways of redirecting, so I'm guessing that you already know what a redirect is. htaccess can also do redirects! Using htaccess for redirects is probably one of the simplest, easiest ways to do it. Obviously you need to be careful with this - if you create an infinite loop then you could cause the server to crash. Use the following:

	Redirect /olddir/oldfile.html http://example.com/newdir/

It should be fairly obvious how this works - olddir/oldfile.html is the old file, and it will be redirected to example.com/newdir/. You must always specify a full URL beginning with http://


## Preventing Directory Listing

If you ever have a directory without an index, the server will usually display a list of all the files in the directory. Often, you do not want to do this, as the directory may contain files you don't want people to know about. There are several ways to do this; you can put a blank index.html file in the directory (resulting in a blank page), or you can use the IndexIgnore command in htaccess.

	IndexIgnore *

This tells Apache not to display any files with * in the name. As * is a wildcard, this is all files. But what do you do if you only want the php files to be ignored? Use this:

	IndexIgnore *.php

It's easy!

On the other hand, if your server is set up to disable directory listing, you can enable it using the following code:

	Options +Indexes

You can also replace the + with a - to disable listing entirely.


## Other useful functions

Set timezone (useful if you live in a different place to the server):

	php_value date.timezone Europe/London
	# or
	SetEnv TZ Europe/London

Set admin email address:

	SetEnv SERVER_ADMIN default@domain.com

Cache images and flash files:

	<FilesMatch ".(flv|gif|jpg|jpeg|png|ico|swf)$">
	Header set Cache-Control "max-age=2592000"
	</FilesMatch>

2592000 is a month in seconds

Set default language:

	DefaultLanguage en-GB

## Using htaccess to disable hotlinking - STOP!

Many website will tell you that it is possible (and advisable) to stop hotlinking using the following code:

	RewriteEngine on
	RewriteCond %{HTTP_REFERER} !^$
	RewriteCond %{HTTP_REFERER} !^http://(www\.)?mydomain.com/.*$ [NC]
	RewriteRule \.(gif|jpg|js|css)$ - [F]

Do NOT do this. It means that people reading RSS feeds can't view images, it means that people linking to your website will have problems, and a few other problems. It causes more problems than it solves.

If you must do this, do one of two things. Either send it to a watermarked version of the same image, or block specific websites, using the following:

	RewriteEngine On
	RewriteCond %{HTTP_REFERER} ^http://(.+\.)?domainone\.com/ [NC,OR]
	RewriteCond %{HTTP_REFERER} ^http://(.+\.)?rivalwebsite\.com/ [NC,OR]
	RewriteCond %{HTTP_REFERER} ^http://(.+\.)?otherwebsite\.com/ [NC]
	RewriteRule .*\.(jpe?g|gif|bmp|png)$ - [F]

In this article, you should have learned about the main features of .htaccess. If you've got any favourites that I missed out, let me know and I'll include it.
