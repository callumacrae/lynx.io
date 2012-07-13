<info>
title: Dynamic styles using PHP and Cookies
author: galaxyAbstractor
date: 1300042800
tags: php, css, dynamic, style
summary: Ever wondered how you can let your visitors customize your sites design in various ways? It can very easily be done with PHP and cookies. Having dynamic styles could add functionality like adjusting text size, color or background color etc.
</info>

Ever wondered how you can let your visitors customize your sites design in various ways? It can very easily be done with PHP and cookies. Having dynamic styles could add functionality like adjusting text size, color or background color etc.

In this example I am gonna show you how to make a form which will show some default style settings and let your visitors change them and have them saved as a cookie so the visitor will keep the style. You should read up about the ternary operator if you haven't already.

First, on the page we display the form on, we want to set some default values for the form if a cookie isn't already set, otherwise we will set the old value.

	<?php
		// Check if the cookie is already set, otherwise set some default styling options
		// Also, we need to unserialize the value of the cookie as we are working with arrays
		$style = !empty($_COOKIE['style']) ? unserialize($_COOKIE['style']) : null;

		// First check if the keys in the arrays are empty, then check if it starts with #
		$body_background_color = !empty($style['body_background_color']) ? (strpos($style['body_background_color'],"#") !== 0 ? "#". $style['body_background_color'] : $style['body_background_color']) : "#fff";
		$body_text_color = !empty($style['body_text_color']) ? (strpos($style['body_text_color'],"#") !== 0 ? "#". $style['body_text_color'] : $style['body_text_color']) : "#000";
		$body_text_size = !empty($style['body_text_size']) ? $style['body_text_size'] : 12;

		$example_background_color = !empty($style['example_background_color']) ? (strpos($style['example_background_color'],"#") !== 0 ? "#". $style['example_background_color'] : $style['example_background_color']) : "#fff";
		$example_text_color = !empty($style['example_text_color']) ? (strpos($style['example_text_color'],"#") !== 0 ? "#". $style['example_text_color'] : $style['example_text_color']) : "#000";
		$example_text_size = !empty($style['example_text_size']) ? $style['example_text_size'] : 10;

As you can see here, we first have to check if the cookie is set by checking if it is empty. If it isn't, we unserialize the array data stored in the cookie. Then if the indexes in the array is empty or the array is null, they are set to a default value.

Next we want to show the form:

			// If the form hasn't been submitted we should show the form to the user
			if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<link href="style.php" rel="stylesheet" type="text/css" />
	<title>Modify stlye</title>
	</head>
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="post" name="submit">
			<fieldset>
				<label for="background">Backgorund color</label><br />
				<input type="text" id="background" name="body_background_color" value="<?php echo $body_background_color ?>" /><br />
				<label for="textcolor">Text color</label><br />
				<input type="text" id="textcolor" name="body_text_color" value="<?php echo $body_text_color ?>"/><br />
				<label for="textsize">Text size</label><br />
				<input type="text" id="textsize" name="body_text_size" value="<?php echo $body_text_size ?>"/><br /><br />
				<label for="examplebackground">#example background color</label><br />
				<input type="text" id="examplebackground" name="example_background_color" value="<?php echo $example_background_color ?>"/><br />
				<label for="exampletextcolor">#example text color</label><br />
				<input type="text" id="exampletextcolor" name="example_text_color" value="<?php echo $example_text_color ?>"/><br />
				<label for="exampletextsize">#example text size</label><br />
				<input type="text" id="exampletextsize" name="example_text_size" value="<?php echo $example_text_size ?>"/><br /><br />
				<input name="submit" type="submit" value="submit" />
			</fieldset>
		</form>
		<br />
		<div id="example">
			#example Lorem Ipsum herp derp
		</div>
	</body>
	</html>

This is a rather basic form and a div with the id #example containing a bit of text.

Next, if the form has been submitted, we want to update the settings and redirect the user back to this page.

	<?php
			} else {
				// We set the cookie expiration time to 1 month on from the _update_ of values
				$month = 2592000 + time();

				// We need to serialize the $style array as we cannot store the array directly in the cookie
				$style = serialize($_POST);

				// We set the cookie name to "style" and put in our serialized array $style and expiration date $month
				setcookie("style", $style, $month);

				// Reload the page to make sure changes take effect
				header("Location: index.php");

			}
		?>

This here serializes (stores an array as a text representation) the form data and sets it to a cookie called "style", which can later be accessed by using `$_COOKIE['style']`.

Next for the CSS file (which is actually a **.php file**):

	<?php
		header("Content-type: text/css");

		// Check if the cookie is already set, otherwise set some default styling options
		// Also, we need to unserialize the value of the cookie as we are working with arrays
		$style = !empty($_COOKIE['style']) ? unserialize($_COOKIE['style']) : null;

		// First check if the keys in the arrays are empty, then check if it starts with #
		$body_background_color = !empty($style['body_background_color']) ? (strpos($style['body_background_color'],"#") !== 0 ? "#". $style['body_background_color'] : $style['body_background_color']) : "#fff";
		$body_text_color = !empty($style['body_text_color']) ? (strpos($style['body_text_color'],"#") !== 0 ? "#". $style['body_text_color'] : $style['body_text_color']) : "#000";
		$body_text_size = !empty($style['body_text_size']) ? $style['body_text_size'] : 12;

		$example_background_color = !empty($style['example_background_color']) ? (strpos($style['example_background_color'],"#") !== 0 ? "#". $style['example_background_color'] : $style['example_background_color']) : "#fff";
		$example_text_color = !empty($style['example_text_color']) ? (strpos($style['example_text_color'],"#") !== 0 ? "#". $style['example_text_color'] : $style['example_text_color']) : "#000";
		$example_text_size = !empty($style['example_text_size']) ? $style['example_text_size'] : 10;
	?>

	body {
		background-color: <?php echo $body_background_color ?>;
		color: <?php echo $body_text_color ?>;
		font-size: <?php echo $body_text_size ?>px;
	}

	#example {
		background-color: <?php echo $example_background_color ?>;
		color: <?php echo $example_text_color ?>;
		font-size: <?php echo $example_text_size ?>px;
	}

The code in the header is the same code we had in the previous file with the addition of header("Content-type: text/css"); which tells the browser that this really is a css file. Then we have the layout where we echo the values.

## mySQL implementation

To take it further, if you have registered users and want them to be able to have their own style, computer-wide, you could store the serialized array in the user table. Do not forget to validate and escape the form input before sending it to mySQL though. Later, you could just fetch the row from the database instead of fetching the cookie.