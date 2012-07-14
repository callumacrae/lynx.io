<info>
title: Utilising the MVC architecture
author: callumacrae
date: 1303036920
tags: php, architecture, mvc
summary: The Model-View-Controller (MVC) architecture is an architecture most commonly used to separate what is known as "domain logic" - the code that powers the backend - from the user interface - what the user sees. This makes your code clearer, easier to work with, and has the advantage that you can very easily had multiple people working on the same project without conflicts, and without the need for a version control software such as Git or SVN.
</info>

The Model-View-Controller (MVC) architecture is an architecture most commonly used to separate what is known as "domain logic" - the code that powers the backend - from the user interface - what the user sees. This makes your code clearer, easier to work with, and has the advantage that you can very easily had multiple people working on the same project without conflicts, and without the need for a version control software such as Git or SVN.

### The Model

The model contains most of the domain logic. Although different people and frameworks use the term differently, it was originally used as a "logical data container." For example, you could have a user model that the controller would use to get or modify user information, and the view would use it to retrieve user information to display it to the user, or a posts model that handles the posts for a forum; e.g. retrieves posts from the database, submits a new post, etc. A lot of frameworks (my own included) use the model to handle all modification and retrieval of data in the application.

Models can be as powerful or small as your want them to be - they can be thousands of lines long, or only a few.

### View

The view contains the user interface. When using MVC in PHP, this will generally be the HTML. Neither the controller nor model should output anything to the user (excluding error pages, but sometimes not even that). It can be written in PHP, or sometimes the developer takes separating the code from the HTML far too seriously and writes their view in pure HTML, using code like this:

	<!-- FOREACH users AS user --><strong>Username:</strong> {%user->name%}<br /><!-- ENDFOREACH -->

The advantage of this is that the designer does not have to know the language that the application is written in, just the language that it is being outputted in - in this example, PHP and HTML respectively. However, I personally believe that the disadvantages outweigh the advantages - the designer will still have to learn the syntax. It will also take time to parse, although it can be cached.

### The Controller

The controller connects everything together - it receives user input before calling the correct models, then creates a response from the view and sending it.

## Example Usage

For this example, we will be writing an application which connects to the database and prints the specified user information into the browser. You can find the full code [here](https://gist.github.com/912297). Read it carefully and see what you can work out for yourself, and then I will run through the less obvious bits of code below:

### index.php ([gist](https://gist.github.com/912297#file_index.php))

index.php basically just calls the controller. First, it sets the ROOT constant (because `__DIR__` is a magic constant and so changes between files) and sets the `$path_info` array. `$_SERVER['PATH_INFO']` is a special variable that gets anything appended to file name - believe it or not, index.php/user/all is a valid file name, and is how this is going to work. The URL index.php/user/all will produce the following array after it has been exploded:

	Array
	(
		[0] => user
		[1] => all
	)

From this, we can tell which controller to load, and then which method to run in that controller. In this instance, it is the "user" controller and the "all" method. It then checks whether the file and method exist, and calls the method. Optionally, if something else is sent in the path (eg index.php/user/all/anothervar), it is sent as an argument to the method. We will use this later for the user/info method.

### controllers/user.php ([gist](https://gist.github.com/912297#file_user.php))

The first thing this file does is include the model. We will explore the model later. Then, it defines the User class. The User class has three methods - `__construct`, `info` and `all`. None of them actually do too much, they just get data from the model and pass it on to the correct view. You may notice  in the info method, we use foreach on a method - yes, you can do this, it's not just for arrays! The only data that could span multiple lines is `$user->addr`, so instead of calling `nl2br` in the foreach, we call it separately for just that variable.

### models/user.php ([gist](https://gist.github.com/912297#file_user.php))

The user model gets all the data to do with the users. On construction, it establishes a connection to the database using PDO (read my article on PDO [here](http://lynx.io/articles/pdo-basics/)). The other two methods are equally obvious - the `get` method returns a single user, using a [ternary](http://lynx.io/shortcut-ternary-operator/) to return false if the user cannot be found, and the `all` method returns all the users, again using a ternary to return false if there are no users.

### views/user_info.php ([gist](https://gist.github.com/912297#file_user_info.php)) and views/user_list.php ([gist](https://gist.github.com/912297#file_user_list.php))

These are the view files. In user_list.php, I am using template notation for the foreach:

	<?php foreach ($array as $variable): ?>
	//some html here
	<?php endforeach; ?>

This is a lot cleaner than using parenthesis, as there is more HTML than PHP. Some people disagree with the use of template notation, but used for templates only I would consider it to be acceptable.

The MVC architecture is not specific to PHP. It was first used by Trygve Reenskaug in the Smalltalk language. Some languages support MVC better than others; Ruby on Rails actually forces it. It is quite commonly used in PHP, and quite a lot of frameworks use it, including Codeigniter, Symfony and the lynx framework. It is better for larger applications, but can still be used for small applications.

That concludes my article on the Model-View-Controller architecture. I hope you have found it useful and apply it to your future projects; if you have any questions just leave it in a comment as usual.