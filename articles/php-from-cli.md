<info>
title: Running PHP applications from the command line
author: callumacrae
date: 1294725600
tags: PHP, CLI
summary: I've always found it useful to be able to run PHP applications from the command line: not only does it allow me to quickly view the output of my code from the command line - where I do the majority of my developing - but it also allows me to make proper command line applications from within PHP. Okay, quite a lot of stuff is not possible, but it's still fun. This applies to Unix only, I believe.
</info>

I've always found it useful to be able to run PHP applications from the command line: not only does it allow me to quickly view the output of my code from the command line - where I do the majority of my developing - but it also allows me to make proper command line applications from within PHP. Okay, quite a lot of stuff is not possible, but it's still fun. This applies to Unix only, I believe.

The first way (the old way):

Run this from bash:

	php index.php

That's not an application, as it is just telling `php` to run `index.php`.

To be able to run it simply by typing the file name, follow these steps:

1\. Run `whereis php` in a terminal and copy what it prints.

2\. Add the following code to the top of your php file:

	#! /usr/bin/php

/usr/bin/php is what `whereis php` gave me, replace it with what it gave you. Basically, this is telling the command line the location to PHP, and where to run the application. It is called a hashbang due to the `#!`.

3\. Make the application an application by running the following code in the command line (where index.php is your application):

	chmod +x index.php

You can then run your application by running the following:

	./index.php

It's that simple!
