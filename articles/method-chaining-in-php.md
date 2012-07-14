<info>
title: Method Chaining in PHP
author: callumacrae
date: 1307182920
tags: php, method chaining, oop
summary: Method chaining allows for shorter and cleaner code, and in this article I will explain how it is possible in PHP.
</info>

Method chaining allows for shorter and cleaner code, and in this article I will explain how it is possible in PHP. The best way to explain method chaining is to show you an example of it:

Without method chaining:

	$abc = new Site();
	$abc->add_info('title', 'Hello world!');
	$abc->add_info('body', $body);
	$abc->add_info('footer', 'Copyright Callum Macrae');

With method chaining:

	$abc = new Site();
	$abc->add_info('title', 'Hello world!')
		->add_info('body', $body)
		->add_info('footer', 'Copyright Callum Macrae');

Or slightly more obvious:

	$abc = new Site();
	$abc->add_info('title', 'Hello world!')->add_info('body', $body)->add_info('footer', 'Copyright Callum Macrae');

As you can see, the code is a lot cleaner with method chaining. Method chaining is quite commonly used in other languages, such as JavaScript. The following code excerpt is off [the Node.js homepage](http://nodejs.org/):

	http.createServer(function (req, res) {
	  res.writeHead(200, {'Content-Type': 'text/plain'});
	  res.end('Hello World\n');
	}).listen(1337, "127.0.0.1");

Method chaining! It's clearer when displayed without the parameters:

	http.createServer(function).listen(port, ip);

<p>&nbsp;</p>

You can do it by returning `$this` at the end of your methods. For example:

	<?php

	class EchoIt {
		private $text = array();
		public function add($text) {
			$this->text[] = $text;
			return $this;
		}

		public function out() {
			echo join($this->text, ' ') . PHP_EOL;
			$this->text = array();
			return $this;
		}
	}

	$text = new EchoIt;
	$text->add('Hello')->add('world')->out()
		->add('This')->add('is')->add('a')->add('test')->out();

This will output:

	Hello world
	This is a test

<p>&nbsp;</p>

It's all fairly simple. One of the great things about this example is that PHP passes objects by reference, so the following code would do the same thing:

	$text->add('Hello')->add('world');
	$text->out();
	$text->add('This')->add('is')->add('a')->add('test');
	$text->out();