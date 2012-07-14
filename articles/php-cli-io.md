<info>
title: IO: Accepting command line input in PHP
author: callumacrae
date: 1321987080
tags: php, cli, io, stdin
summary: While writing an application, you may sometimes feel the need to create a script that can communicate with the user through the command line – perhaps you don't feel the need to write an entire web GUI for your install script, or you just want to experiment.
</info>

While writing an application, you may sometimes feel the need to create a script that can communicate with the user through the command line – perhaps you don't feel the need to write an entire web GUI for your install script, or you just want to experiment. Don't worry, because it is very easy in PHP to read the input:

In this article we will be following an extremely simple script. To begin with, it is very short:

	<?php
	
	system('clear');
	
	echo 'Welcome to io.php. Please type a command.' . PHP_EOL . PHP_EOL . '> ';
	
	while (($line = trim(fgets(STDIN))) !== false) {
		switch ($line) {
			case 'about':
				echo 'A simple command line switch by Callum Macrae of lynx.io';
				break;

			case 'exit':
				echo 'Exiting...' . PHP_EOL . PHP_EOL;
				exit;

			default:
				echo 'Command not found.';
				break;
		}
		echo PHP_EOL . '> ';
	}


It doesn't do much. First, it clears the command line so that anything echoed will display at the top of the screen. This will only work in unix-like systems, but most servers use Unix or Linux anyway. Then, it echos a welcome to the user, and a couple new lines. If you use HTML line breaks (`<br />`), they will not display correctly – as it is outputting plain text and not HTML, it will be displayed as-is. For this reason, you should use the EOL constant – `PHP_EOL`. This is equivalent to `\n` or `\r\b` on Windows systems.

Then, we have the following code:

	$line = trim(fgets(STDIN))

The `STDIN` constant is effectively the file stream produced by `fopen('php://stdin/', 'r')` - the raw input stream of the PHP process (standard input). When the user presses enter, the entire line (including the line return) is sent. This is why we are using `trim` - it trims any whitespace and the newline.

Then, we have a simple switch statement to switch between valid commands. At this point, it isn't really a command, as `$line` is the entire line - you would want to split it by spaces and use the first word only, like this:

	$line = explode(' ', $line);
	switch ($line[0]) {

<p>&nbsp;</p>

That's pretty much it. There a couple improvements that could be made:

## Clearing the command line.

The method used in the example code to clear the command line only works in Unix-like systems such as Linux and OS X, and will throw an error in Windows. The equivalent command for Windows is `cls`, so we can simply check whether it is Windows and use the `cls` if it is:

	system((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'cls' : 'clear');

## Checking whether we're actually in the command line

Obviously, clearing the command line is useless if we're not in the command line - as is the entire script. For this reason, we need to detect whether the user is actually running the script through the command line or not. PHP has a built in constant for this, `PHP_SAPI`. It returns the type of interface (Server API) that PHP is using, which when ran from the command line will be "`cli`". Knowing this information, we can use the following few lines of code to cancel the script if it is not being ran from the command line:

	if (PHP_SAPI !== 'cli') {
		echo 'This script must be ran from the command line. Exiting...';
		exit;
	}

## Formatting text

Obviously, we cannot use HTML and CSS to format our text. The way text is formatted for the command line is fairly complicated, so I wrote a class to do it for you; you can find it [here](https://gist.github.com/1386422) (if you're interested as to how it actually works, try [this](http://www.tldp.org/HOWTO/Bash-Prompt-HOWTO/x329.html)).

You can use the class like this:

	echo FormatStringCLI::color('Some red text', 'red');

	$text = 'Some bold red text on a yellow background';
	echo FormatStringCLI::bold(FormatStringCLI::color($text, 'red', 'yellow'));

<p>&nbsp;</p>

Our final code could be something like this:

	<?php

	if (PHP_SAPI !== 'cli') {
		echo 'This script must be ran from the command line. Exiting...';
		exit;
	}

	include('format_string_cli.php');

	system((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'cls' : 'clear');

	echo FormatStringCLI::bold('Welcome to io.php. Please type a command.');
	echo PHP_EOL . PHP_EOL . FormatStringCLI::color('> ', 'dark_grey');

	while (($line = trim(fgets(STDIN))) !== false) {
		$line = explode(' ', $line);
		switch ($line[0]) {
			case 'about':
				echo 'A simple command line switch by Callum Macrae of lynx.io';
				break;

			case 'exit':
				echo 'Exiting...' . PHP_EOL . PHP_EOL;
				exit;

			default:
				echo 'Command not found.';
				break;
		}
		echo PHP_EOL . $PS1;
	}