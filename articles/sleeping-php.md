<info>
title: Sleeping in PHP
author: callumacrae
date: 1293865262
tags: functions, php, sleep
summary: I've seen a few people asking how they can sleep or pause their PHP script, so in this article I am going to do two things - I am going to explain how you can sleep your script in PHP, and I am also going to ask this question: Why would you want to?
</info>

I've seen a few people asking how they can sleep or pause their PHP script, so in this article I am going to do two things - I am going to explain how you can sleep your script in PHP, and I am also going to pose this question: Why would you want to?

There are a few functions you can use:

## `sleep($seconds)`

`sleep()` delays the script for a specified amount of seconds. Simple! The following code would be an example usage of this function:

	<php

	echo date('h:i:s') . PHP_EOL;
	sleep(5);
	echo date('h:i:s');

That would output the time twice, one 5 seconds later than the other, as `date()` returns the time.

## `usleep($nanoseconds)`

Another function you can use for sleeping is `usleep()`, which allows you to specify the amount of time you want the script to sleep for in microseconds.

	<?php

	echo date('h:i:s') . PHP_EOL;
	usleep(2000000);
	echo date('h:i:s');

That code outputs the time twice, two seconds apart.

## `time_nanosleep($seconds, $nanoseconds)`

`time_nanosleep()` allows you to specify the amount of time to sleep for in nanoseconds. You should bear in mind when using it that the overhead added by the function call will be multiple nanoseconds, so you cannot guarentee that it will be 100% accurate.

	<?php

	echo date('h:i:s') . PHP_EOL;
	time_nanosleep(0, 500000000)
	echo date('h:i:s');

<p>&nbsp;</p>

`time_nanosleep()` doesn't exist on some older windows systems. To get around this, check whether the function exists and add it if it doesn't:

	<?php

	if (!function_exists('time_nanosleep')) {
		function time_nanosleep($seconds, $nanoseconds) {
			sleep($seconds);
			usleep(round($nanoseconds / 100));
			return true;
		}
	}

It isn't as precise, but it will probably do.

## `time_sleep_until($timestamp)`

The `time_sleep_until()` function allows you to specify a timestamp when the script should wake up again.

	<?php

	echo time();
	time_sleep_until(time() + 5);
	echo time();

That would sleep the script for 5 seconds.

<p>&nbsp;</p>

When using any of these functions, you should keep in mind that most servers have the maximum execution time set to 30 seconds, so be careful! If you see any 500 errors, it usually means that your script has slept for too long, so you need to make it sleep less.
