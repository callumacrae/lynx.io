<info>
title: Bad Coding Practices to Avoid
slug": "bad-coding-practices-to-avoid
author: callumacrae
date: 1294812000
tags: php, coding practice, comments, spacing, rant
summary: One of most annoying things I have to face when coding is other people's bad code. I consider my own coding standard to be fairly good, but sometimes I have to work with code that hasn’t been coded well at all. Messy code is difficult to read, difficult to work with, and it can also slow your code down.
</info>

One of most annoying things I have to face when coding is other people's bad code. I consider my own coding standard to be fairly good, but sometimes I have to work with code that hasn’t been coded well at all. Messy code is difficult to read, difficult to work with, and it can also slow your code down.

## Naming

Everything should be named logically. For example, use `$post` for information about a post, not `$var`. Only ever use single character variable names (eg. `$i`) in loops. Consistency is almost as important as naming stuff logically; you should also standardise your variable names. I always use camel caps instead of underscores, so I would have `$postName`, not `$post_name` or `$postname`. This saves me time having to look back to remember what I called a variable.

For example, WordPress has a function called `__()`. Whose idea was that? It's not very descriptive, and I didn't even realise it was a function at first. When I did realise, searching `__()` on Google didn't return much!

## Spacing

First, an example:

	<?php
	$data = new PDO("mysql:host=localhost;dbname=php,callum,newarray,array(PDO::ATTR_PERSISTENT=>true));
	$data->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$res = $data=>query("SELECT * FROM config WHERE config='time'");
	if ($res->rowCount()){while($row=$res->fetch()){if(!is_int($row->time):die();else:$open=$row->time;endif;break;}}else
	die();
	$today = time();if($today>$open): ?>
	
	//some html here
	
	<? endif; ?>

That’s horrible. I don’t even know whether it works, as I haven’t tested it. It took me a lot longer to write than normal code. Granted, it takes less disk space, but who cares? It’s ugly and impossible to work with. Again, be consistent with your spacing. If you're going to put tabs in one place, put them in all the other places, too.

## Comments

Another bad coding practice I dislike is when the author of the code can't be bothered to leave comments. It only uses a few extra lines to leave a comment! It makes it extremely difficult to understand what is happening in the code, especially if it is long or uses stupid variable names. I cannot think of a disadvantage of not leaving comments - it actually makes it faster to edit if you leave comments. So seriously, always leave comments in your code.

	// A comment

## Always check for security flaws WHILE you're coding

It's far easier to check for security flaws (such as having vulnerabilities for SQL injections) while you're writing the code, not after discovering the vulnerabilities and having to trawl through thousands of lines of code looking for a single line of code.

## Error messages

Your error messages should be useful. They should not just say "Could not connect", they should say (for example), "Could not connect to database: $db->connect() failed on line 426 of db.php". Look into debug`_backtrace, too.

There should be two levels of error messages: The error message that is displayed to you when something goes wrong, and the error message that is displayed to your users. To them, "$db->connect() failed" is jargon and doesn't help them at all.

<br>

Of course, sometimes you will struggle to stick to all of these, but attempting to do so will help you. Also, check out <http://www.strauss.za.com/sla/code_std.asp> (but remember that it is a _joke_!)
