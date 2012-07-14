<info>
title: Rumour Debunked: Single quotes vs double quotes in PHP
author: callumacrae
date: 1325788320
tags: php
summary: There is a popular rumour that while writing PHP, you should use double quotes wherever possible. This used to be true - before PHP 5.1 was released, there was a significant difference in speed between double and single quotes, and it was definitely a good idea to use single quotes wherever possible. PHP 5.1 included some optimisations to the opcode parser which improved the double quotes parsing time, and since then, using double quotes hasn't been an issue.
</info>

There is a popular rumour that while writing PHP, you should use double quotes wherever possible. This used to be true - before PHP 5.1 was released, there was a significant difference in speed between double and single quotes, and it was definitely a good idea to use single quotes wherever possible. PHP 5.1 included some optimisations to the opcode parser which improved the double quotes parsing time, and since then, using double quotes hasn't been an issue.

I wrote some simple benchmarks to prove my point:

	<?php

	$max = 1000000;
	$output = '';

	ob_start();

	$starttime = microtime(true);

	for ($i = 0; $i < $max; $i++) {
			echo "test";
	}

	$output .= 'Test one: ' . (microtime(true) - $starttime) . 's' . PHP_EOL;

	$starttime = microtime(true);

	for ($i = 0; $i < $max; $i++) {
			echo 'test';
	}

	$output .= 'Test two: ' . (microtime(true) - $starttime) . 's' . PHP_EOL;

	ob_end_clean();

	echo $output;

I got the following results:

<pre>Test one: 0.070215940475464s
Test two: 0.070168018341064s</pre>

As you can see, the difference is negligible - an average of 0.0479 nanoseconds per test. In comparison, some other common tasks take the following amount of time on my computer:

* Initiating an empty array: 131 nanoseconds
* Defining a constant: 1096 nanoseconds
* Defining an anonymous function: 308 nanoseconds

Check out <http://www.phpbench.com/> for some other examples of times.

<p>&nbsp;</p>

So in summary, it doesn't really matter whether you use single of double quotes as it has no real effect on speed. The only reasons you would use double quotes over single quotes is for aesthetics or for if your project still supports PHP versions less than 5.1.