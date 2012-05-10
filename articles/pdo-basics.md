<info>
title: PHP Data Objects (PDO) - The Basics
author: callumacrae
date: 1293865261
tags: php, database, mysql, pdo, sql
</info>

This is the first half of a two-part tutorial. In this part, I will explain how to connect to, select rows from, and insert data into a database; in the next part, I will cover some more advanced stuff.

<br />

PHP Data Objects (PDO) is an extension for PHP that provides the developer with yet another way to access databases using SQL in PHP. It provides what is called a "data-access abstraction layer", which means that you use the same functions to access the database regardless of which database system (MySQL, MSSQL, Oracle, etc.) you're using. You cannot perform any database functions using the PDO extension by itself; you have to use a database-specific PDO driver to access a database server (although it's not as complicated as it sounds – everything comes installed already). PDO ships by default with PHP 5.1, and is available as a PECL extension for PHP 5.0. PDO requires the Object Orientated features in the core of PHP 5, and so will not run with any earlier versions of PHP.

So why should you use PDO over the alternatives, such as mysql\_\* or MySQLi? The mysql\_ library was meant only for MySQL versions earlier than 4.1, which was released in 2004. It’s 2011 now, meaning that mysql\_\* has been obsolete for 7 years! It is also slow, insecure, and leads to ugly code, as it isn’t object-orientated. You also can't use any of the more recent MySQL functions, either.

Once we have accepted that the mysql\_\* libraries are a bad choice, we have to choose between PDO or MySQLi. They're both good choices, but there are a couple differences. MySQLi only supports MySQL, so if you decide that you want to use a different database system, you cannot easily change. This, however, does add a bit of overhead to PDO, and the MySQLi library is marginally faster. PDO is also more object-orientated than MySQLi, which I prefer.

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

For the connection information, you can just use the information that you would use for mysql\_\* or MySQLi. In the next section we construct the DSN, or "Data Source Name". It’s basically just a string that tells the server what type of database we're connecting to, and how to connect to it. Finally, the last line creates the connection.

## Querying the database

Let's say that you have a table called 'posts' that you want to print all the posts from. The table structure:

	CREATE TABLE posts (
		id int(11) NOT NULL AUTO_INCREMENT,
		user_id int(11) NOT NULL,
		post text NOT NULL,
		PRIMARY KEY (id)
	)

The code used to print the posts is very simple:

	<?php

	include('db.php');

	$statement = $db->query('SELECT * FROM posts');

	while ($result = $statement->fetchObject()) {
			echo $result->post . PHP_EOL;
	}

Pretty simple, right? It queries the database using standard SQL, then fetches an object with the values. You can then do what you want with it, as it is a standard class with the values assigned to variables in the class. You could use `$statement->fetchArray()` to get an array instead.

## Inserting data using prepared statements

Prepared statements is a great feature of PDO which helps secure your code against SQL injection. It works like this:

	<?php

	$statement = $db->prepare('INSERT INTO posts (user_id, post) VALUES (?, ?)');
	$statement->execute(array($user['id'], $post));

It's not as complicated as it looks - first, you have the SQL with question marks instead of the values, then you have the code that executes it with the values in an array as an argument. It's the same as doing this (almost):

	$db->query('INSERT INTO posts (user_id, post)
		VALUES (' . $user['id'] . ', ' . $post . ')');

The advantage of using prepared statements over traditional SQL queries is that input given to prepared statements does not need to be escaped, and so practically nullifies the risk of SQL injection. It's also easier to maintain.

<br />

I hope you found this tutorial useful, I will be writing part two soon.
