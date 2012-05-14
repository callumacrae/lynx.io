<info>
title: PHP array functions
author: callumacrae
date: 1294552800
tags: php, functions, array
summary: There are a huge amount of functions to deal with arrays in PHP, but I will be going through just a few of the most useful or interesting ones. If you would like me to add a function or two to this list, just tell me and I'll do my best.
</info>

There are a huge amount of functions to deal with arrays in PHP, but I will be going through just a few of the most useful or interesting ones. If you would like me to add a function or two to this list, just tell me and I'll do my best.

In this article we will be using a two arrays:

	<?php
	
	$colours_ary = array('blue', 'red', 'orange', 'green');
	$database_ary = array(
	   'username'	=> 'test_username',
	   'database'	=> 'test_database',
	   'password'	=> 'test_password',
	   'rand_text'	=> 'Lorem ipsum sit amet',
	);
	
## Outputting arrays

There are two functions to outputs arrays, `print_r` and `var_dump`. `print_r` just outputs the array, while `var_dump` displays a lot more information such as type:

	<?php
	
	print_r($database_ary);
	var_dump($database_ary);

That would return:

	Array
	(
		[username] => test_username
		[database] => test_database
		[password] => test_password
		[rand_text] => Lorem ipsum sit amet
	)
	array(4) {
	  ["username"]=>
	  string(13) "test_username"
	  ["database"]=>
	  string(13) "test_database"
	  ["password"]=>
	  string(13) "test_password"
	  ["rand_text"]=>
	  string(20) "Lorem ipsum sit amet"
	}

## foreach

`foreach` is easily the most used function to deal with arrays. It cycles through the array, and for every item in the array it executes some specified code.

	foreach ($colours_ary as $value)
	   statement
	foreach ($database_ary as $key => $value)
	   statement

So for example:

	<?php
	
	foreach ($colours_ary as $colour) {
	   $db->query('INSERT INTO table VALUES ("' . $colour . '")');
	}

Or:

	<?php
	
	echo '<ul id="database">';
	
	foreach ($database_ary as $key => $value) {
	   echo '<li id="' . $key . '">' . $value . '</li>';
	}
	
	echo '</ul>';

## is_array

`is_array` is an extremely simple function - it simply returns whether the function is an array or not. It can be used like this:

	<?php
	
	echo is_array($possibly_an_array) ? 'Array' : 'Not an Array';
	
	if (is_array($colours_ary)) {
		foreach ($colours_ary as $value) {
			echo $value . ', ';
		}
	} else {
		echo $colours_ary;
	}

That code could be shortened, but I wanted to include two examples of how `is_array` can be used.

## array\_values

While this function seems a bit pointless at first, I have used it on a couple occasions where not using it would have caused an error. It removes the keys from the array and replaces them with numbers.

	<?php
	
	print_r(array_values($database_ary));

That will output:

	Array
	(
		[0] => test_username
		[1] => test_database
		[2] => test_password
		[3] => Lorem ipsum sit amet
	)


## array\_keys

`array_keys` is the opposite of `array_values`, it returns all the keys as an array:

	<?php
	
	print_r(array_keys($database_ary));

That will return:

	Array
	(
		[0] => username
		[1] => database
		[2] => password
		[3] => rand_text
	)


## array\_merge

`array_merge` is an incredibly useful function that merges two or more arrays together:

	<?php
	
	$new_array = array_merge($colours_ary, $database_ary);
	print_r($new_array);

That will return:

	Array
	(
		[0] => blue
		[1] => red
		[2] => orange
		[3] => green
		[username] => test_username
		[database] => test_database
		[password] => test_password
		[rand_text] => Lorem ipsum sit amet
	)


## asort

`asort` is short for array sort. It alphabetically orders the array by the values.

	<?php
	
	asort($colours_ary);
	print_r($colours_ary);

That will return:

	Array
	(
		[0] => blue
		[3] => green
		[2] => orange
		[1] => red
	)

You can also use arsort - array reverse sort. It will sort the array in reverse order.

## array\_flip

`array_flip` switches the keys and the values of an array - the keys become the values, and the values become the keys. I'm assuming you don't need an example - it's pretty obvious :)

You can also use this function to remove null elements from an array (thanks to h3x on php.net for this):

	<?php
	$ar = array(null,'1','2',null,'3',null);
	print_r($ar);
	/*
	result:
	Array
	(
		[0] => 
		[1] => 1
		[2] => 2
		[3] => 
		[4] => 3
		[5] => 
	)
	*/
	
	print_r(array_flip(array_flip($ar)));
	/*
	result:
	Array
	(
		[1] => 1
		[2] => 2
		[4] => 3
	)
	*/
	?>


## array\_reverse

`array_reverse` simply returns the array backwards.

	<?php
	
	print_r(array_reverse($database_ary));

That will return:

	Array
	(
		[rand_text] => Lorem ipsum sit amet
		[password] => test_password
		[database] => test_database
		[username] => test_username
	)

## implode / explode

`implode` and `explode` are functions that turn arrays into strings and back. I will cover `implode` first. `implode` turns an array into a string, like this:

	<?php
	
	echo implode(', ', $colours_ary);

That will return `blue, red, orange, green`. `explode` does the opposite, and turns a string into an array:

	<?php
	
	$string = 'value0, value1, etc, value3';
	$array = explode(', ', $string);
	print_r($array);

That will return:

	Array
	(
		[0] => value0
		[1] => value1
		[2] => etc
		[3] => value3
	)
