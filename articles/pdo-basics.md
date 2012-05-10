<info>
title: PHP Data Objects (PDO) - The Basics
author: callumacrae
date: 1293865261
tags: php, database, mysql, pdo, sql
</info>

This is the first half of a two-part tutorial. In this part, I will explain how to connect to, select rows from, and insert data into a database; in the next part, I will cover some more advanced stuff.

<br />

PHP Data Objects (PDO) is an extension for PHP that provides the developer with yet another way to access databases using SQL in PHP. It provides what is called a "data-access abstraction layer", which means that you use the same functions to access the database regardless of which database system (etc MySQL, MSSQL, Oracle) you're using. You cannot perform any database functions using the PDO extension by itself; you have to use a database-specific PDO driver to access a database server (although it's not as complicated as it sounds – everything comes installed already). PDO ships by default with PHP 5.1, and is available as a PECL extension for PHP 5.0; PDO requires the new OO (Object Orientated) features in the core of PHP 5, so will not run with earlier versions of PHP.

So why should you use PDO over the alternatives, such as mysql\_\* or MySQLi? The mysql\_ library was meant only for MySQL versions earlier than 4.1, which was released in 2004. It’s 2011 now, meaning that mysql\_\* has been obsolete for 7 years! It is also slow, insecure, and leads to ugly code, as it isn’t object-orientated. You also can't use any of the more recent MySQL functions, either. The only advantage PDO has over MySQLi is that MySQLi supports only MySQL – if you want to use a different database system, you cannot use MySQLi. PDO is also more object-orientated than MySQLi, which I consider to be a good thing.

## Connecting to the database

Use the following code to connect to the database:

	<?php

	// Database connection info
	$host = 'localhost';
	$port = 3306;
	$database = 'yourdatabase';
	$username = 'yourusername';
	$password = 'yourpassword';

	// Construct the DSN
	$dsn = "mysql:host=$host;port=$port;dbname=$database";

	// Create the connection
	$db = new PDO($dsn, $username, $password);

Let's break that down a bit.

For the connection information, you can just use the information that you would use for mysql\_\* or MySQLi. In the next section we construct the DSN, or "Data Source Name". It’s basically just a string that tells the server what type of database we’re connecting to, and how to connect to it. Finally, the last line creates the connection.

## Querying the database

Let's say that you have a table called 'posts' that you want to query, and print all the posts:

	CREATE TABLE posts (
		id int(11) NOT NULL AUTO_INCREMENT,
		user_id int(11) NOT NULL,
		post text NOT NULL,
		PRIMARY KEY (id)
	)

The code used to do this is very simple:

	<?php

	include('db.php');

	$statement = $db->query('SELECT * FROM posts');

	while ($result = $statement->fetchObject()) {
			echo $result->post . PHP_EOL;
	}

Pretty simple, right? It queries the database using standard SQL, then fetches an object with the values. You can then do what you want with it, it's a standard class, with the values assigned to variables in the class.

## Inserting data using prepared statements

Prepared statements is a great feature of PDO which secures your database against SQL injection. It works like this:

	<?php

	$statement = $db->prepare('INSERT INTO posts (user_id, post) VALUES (?, ?)');
	$statement->execute(array($user['id'], $post));

It's not as complicated as it looks - first, you have the SQL with question marks instead of the values, then you have the code that executes it with the values in an array as an argument. Basically, you're giving it this:

	$db->query('INSERT INTO posts (user_id, post)
		VALUES (' . $user['id'] . ', ' . $post . ')');

So why should you use prepared statements? The first code looks better, but the main reason is that using prepared statements makes your code much more secure against SQL injections.

<br />

I hope you found this tutorial useful, I will be writing part two soon.
