<info>
title: Working with date and time
author: callumacrae
date: 1293948000
tags: functions, php, date, time
summary: There are many function in PHP for working with date and time. In this article, I will be explaining the most commonly used ones.
</info>

There are many function in PHP for working with date and time. In this article, I will be explaining the most commonly used ones. Please note that the dates are in DD/MM/YYYY format, eg 31/12/2012

## time

The `time` function is the function that I use most frequently. It takes no parameters, it simply returns the current unix timestamp - the amount of seconds since the Unix Epoch (1st of January 1970, 00:00:00 GMT). For example, this site opened at 1293843661 - 01/01/11 01:01:01.

	<?php echo time(); ?>

## microtime

`microtime` returns the unix time with microseconds as a string:

	<?php echo microtime(); ?>

At the time of writing, that returned `0.59021500 1293714593` - 1293714593 is the timestamp, and 0.59021500 is the miliseconds (units: seconds). You can also use `microtime(true)`, which would return `1293714593.590` as a float. `microtime` is good for timing how long some code takes to execute:

	<?php

	$starttime = microtime(true);

	// some code here

	echo 'Time taken: ' . (microtime(true) - $starttime);

That exact code returns `0.00022006034851074` for me, but obviously it depends what code you put between the two microtime calls, and the hardware that you're running the code from.

## strtotime

`strtotime` takes a string and converts it to a timestamp. It's pretty simple really:

	<?php

	echo strtotime('now') . PHP_EOL;
	echo strtotime('25 December 2010') . PHP_EOL;
	echo strtotime('+1 day') . PHP_EOL;
	echo strtotime('+2 weeks 2 days 2 hours 2 seconds') . PHP_EOL;
	echo strtotime('next Thursday') . PHP_EOL;
	echo strtotime('last Thursday');

This would return something like this:

	1324508816
	1293235200
	1324595216
	1325898418
	1324512000
	1323907200

You can check to see whether it has worked using the following code:

	<?php

	$str = 'This string clearly isn\'t a date';

	if (($timestamp = strtotime($str)) === false) {
		echo '$str isn\'t a timestamp';
	} else {
		echo '$str is a timestamp - ' . date('l dS \o\f F Y h:i:s A', $timestamp);
	}

## date

The `date` function formats a unix timestamp to a human readable date, like 31/12/2010 or 31 December 2010. It takes two arguments, syntax and timestamp, where timestamp is optional. If timestamp isn't specified, it uses the current timestamp.

Example:

	<?php echo date('d/m/Y'); ?>

That will echo `30/12/2010`. The weird string, `d/m/Y`, is the format of date you want returning. The most commonly used are as follows:

* `l jS \of F Y h:i:s A` - Monday 28th of August 2005 03:12:46 PM
* `d/m/Y` - 28/08/2005
* `H:i:s` - 21:23:34

You can find the full list [here](http://php.net/manual/en/function.date.php).

## checkdate

`checkdate` simply validates a Gregorian date. It returns a boolean value. It works as follows:

	<?php

	echo (checkdate(12, 31, 2010)) ? 'true' : 'false';  // true
	echo (checkdate(31, 13, 2010)) ? 'true' : 'false';  // false

## mktime

`mktime` turns a date into a unix timestamp. It is similar to `strtotime` but works differently.

	<?php

	$hour = 12;
	$minute = 23;
	$second = 0;
	$month = 9;
	$day = 28;
	$year = 2010;

	echo mktime ($hour, $minute, $second, $month, $day, $year);

That code returns `1285676580`. If you miss out arguments, it defaults to the current time / date. Some websites still tell you about `$is_dst` as the last argument, but that was deprecated a few years back.
