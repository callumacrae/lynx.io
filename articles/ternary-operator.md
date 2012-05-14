<info>
title: The If Shortcut: The Ternary Operator
author: callumacrae
date: 1294293600
tags: PHP, shortcuts
summary: The ternary operator is a shortcut comparison operator that replaces an if-else statement in a PHP script. If you use a lot of if-else statements in your scripts, using the ternary operator can shorten your code hugely. The ternary operator is very simple to use, but it does tend to confuse new PHP programmers.
</info>

Have you ever seen the following code and wondered what it does?

	<?php

	$id = (isset($_GET['id'])) ? $_GET['id'] : 1;
	$name = (isset($_GET['name'])) ? $_GET['name'] : 'Anonymous';
	$email = (isset($_GET['email'])) ? $_GET['email'] : 0;

This is known as the ternary operator.

The ternary operator is a shortcut comparison operator that replaces an if-else statement in a PHP script. If you use a lot of if-else statements in your scripts, using the ternary operator can shorten your code hugely. The ternary operator is very simple to use, but it does tend to confuse new PHP programmers.

Basically, it's a short way of writing:

	<?php

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		$id = 1;
	}

	if (isset($_GET['name'])) {
		$name = $_GET['name'];
	} else {
		$name = 'anonymous';
	}

	if (isset($_GET['email'])) {
		$email = $_GET['email'];
	} else {
		$email = 0;
	}


As you can see, it is significantly shorter (and often far easier to read). Let’s break it down a bit:

	<?php

	$varname = (statement) ? truecode : falsecode;

Fairly obvious?

**statement** - the statement to test. For example, could test a variable to see whether it matches some regex.  
**truecode** - the code to execute if the statement returns true.  
**falsecode** - the code to execute if the statement returns false

## What can this be used for?

It is very good for displaying different text to different people, for example:

	<?php
	
	echo ($country === 'UK') ? 'Welcome!' : 'This website is UK only, sorry';

<br>

In PHP 5.3, the optional adaptation was introduced:

	<?php
	
	$notset = $_GET['var'] ?: 'Variable not set';

If `$_GET['var']` is set, `$notset` will be set to that. If it isn't, it will be set to "Variable not set".


## A couple examples

	<div class="content" id="<?php echo (is_home()) ? 'wrapper' : ''; ?>">

	<?php
	
	$vartrue = 'Thanks for reading.';
	$varfalse = 'Read it again, or ask in a comment.';
	
	$message = ($understood) ? $vartrue : $varfalse;
	
	echo $message;

Thanks for reading.
