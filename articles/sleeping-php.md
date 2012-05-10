<info>
title: Sleeping in PHP
author: callumacrae
date: 1293865262
tags: functions, PHP, sleep()
</info>

I've seen a few people asking how they can sleep or pause their PHP script, so in this article I am going to do two things - I am going to explain how you can sleep your script in PHP, and I am also going to ask this question: Why would you want to?

There are a few functions you can use:

## `sleep($seconds)`

`sleep()` delays the script for the specified amount of seconds. Simple! An example would be this:

	<php

	echo date('h:i:s') . PHP_EOL;
	sleep(5);
	echo date('h:i:s');

This should obviously output the time twice, one 5 seconds later than the other.

NOTE: `date()` returns the time.

## `usleep($nanoseconds)`

Another function you can use for sleeping is `usleep()`, which allows you to specify the amount of time you want the script to sleep for in microseconds.

	<?php

	echo date('h:i:s') . PHP_EOL;
	usleep(2000000);
	echo date('h:i:s');

That code echos the time twice, two seconds apart.

## `time_nanosleep($seconds, $nanoseconds)`

`time_nanosleep()` allows you to specify the amount of time to sleep for in nanoseconds. It seems slightly pointless to me, but there must be a use for it.

	<?php

	echo date('h:i:s') . PHP_EOL;
	time_nanosleep(0, 500000000)
	echo date('h:i:s');

<br />

`time_nanosleep()` doesn’t work on some older windows systems. To get around this, use:

	<?php

	if (!function_exists('time_nanosleep'))
	{
		function time_nanosleep($seconds, $nanoseconds)
		{
			sleep($seconds);
			usleep(round($nanoseconds/100));
			return true;
		}
	}

## `time_sleep_until($timestamp)`

`time_sleep_until()` allows you to specify a timestamp when the script should wake up again.

	<?php

	echo time();
	time_sleep_until(time() + 5);
	echo time();

That would sleep the script for 5 seconds.

<br />

NOTE: You should also keep in mind that most servers have the maximum execution time set to 30 seconds, so be careful! If you see any 500 errors, it usually means that your script has slept for too long, so you need to make it sleep less.
