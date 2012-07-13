<info>
title: Using eval() properly
slug: eval-properly
author: callumacrae
date: 1295071200
tags: php, eval, security
summary: eval() is a PHP function that allows the user to execute a string as PHP code. In this function I will explore when the right and wrong times to use eval are.
</info>

`eval()` is a PHP function that allows the user to execute a string as PHP code:

	eval('echo "Hello World!";');

That will output "Hello World!" (obviously).

Pretty simple?

Not quite. It can provide some interesting security holes, to the extent that I have seen a LOT of people saying that eval() should never be used.

> "If eval() is the answer, you're almost certainly asking the wrong question" – Rasmus Lerdorf, creator of PHP

In all fairness to them, `eval()` can be a huge security problem if used wrong. For example:

	<?php
	
	$food = array(
		'sweet'		=> 'apple',
		'sour'		=> 'lemon',
		'spicy'		=> 'chili',
	);
	
	$myfood = $_REQUEST['food'];
	
	eval('echo "You asked for " . $food[\'' . $myfood . '\'];');

That's a pretty stupid use of eval, but I have seen similar more than once. That code is vulnerable; for example, if we go to:

	thatfile.php?food=' . `rm -rf *` . '

I've just deleted all your files. Okay, it's not that easy, but you can kind of see how it works. Two ways of stopping this: You can either insert some validation on line 10 like this:

	if (!isset($food[$myfood])) {
		die('Sorry, we do not have this food');
	}

Or you can stop using eval! It's not difficult to NOT use eval for this.

Always be careful when using eval. If it is compromised, it can be extremely bad for you and your site (especially if you have stuff like exec() enabled).

<p>&nbsp;</p>

So some people will be saying: where SHOULD eval be used? Here are a couple examples:

* Pulling code from a database and executing it (for example, for a cms)
* Using `eval(file_get_contents('yourfile.php'))` in the output buffer

I can't think of any others. Anyone got any?
