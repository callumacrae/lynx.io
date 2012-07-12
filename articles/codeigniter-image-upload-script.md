<info>
title: Creating a (very) basic image upload script using Codeigniter
author: callumacrae
date: 1295129520
tags: php, scripts, codeigniter, image upload
summary: In this article I will show you a very basic image upload script I wrote using Codeigniter. I will also show you how it works, and suggest how it could be improved. Feel free to take the code from here and adapt it for your own website.
</info>

In this article I will show you a very basic image upload script I wrote using Codeigniter. I will also show you how it works, and suggest how it could be improved. Feel free to take the code from here and adapt it for your own website.

Codeigniter is an open source web application framework written in PHP. You can find its website [here](http://codeigniter.com/), with a summary of its features and why you should use it. I've been using it because I want to compare all the major PHP frameworks, such as CakePHP, Symfony etc. I've started with Codeigniter, and I will be writing about my experience with other frameworks. The first script I wrote in Codeigniter was a very basic script, an image upload script. The aim was to create a script that could be easily adapted to include, for example, a login script. At the moment all it does it upload the image, encrypt the filename, and put it in a directory of your choice. It then inserts a row into the database with the image information, and send the user a link to their image.


## The SQL Table

First, we need to create a table.

	CREATE TABLE upload (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  title varchar(100) NOT NULL,
	  file varchar(100) NOT NULL,
	  width int(11) NOT NULL,
	  height int(11) NOT NULL,
	  type varchar(100) NOT NULL,
	  size int(11) NOT NULL,
	  date int(11) NOT NULL,
	  PRIMARY KEY (id)
	);

It may need some minor adjustment, but it does the job.

## /system/application/controller/upload.php

	<?php

	class Upload extends Controller {
		function __construct() {
			parent::Controller();
			$this->load->helper(array('form', 'url'));
		}

		function index() {
			$this->load->view('upload_form', array('error' => ' ' ));
		}

		function do_upload() {
			$config = array(
				'upload_path'	=> './uploads/',
				'allowed_types'	=> 'gif|jpg|png',
				'max_size'		=> '100',
				'max_width'		=> '1024',
				'max_height'	=> '768',
				'encrypt_name'	=> true,
			);

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('upload_form', $error);
			} else {
				$upload_data = $this->upload->data();
				$data_ary = array(
					'title'		=> $upload_data['client_name'],
					'file'		=> $upload_data['file_name'],
					'width'		=> $upload_data['image_width'],
					'height'	=> $upload_data['image_height'],
					'type'		=> $upload_data['image_type'],
					'size'		=> $upload_data['file_size'],
					'date'		=> time(),
				);

				$this->load->database();
				$this->db->insert('upload', $data_ary);

				$data = array('upload_data' => $upload_data);
				$this->load->view('upload_success', $data);
			}
		}
	}

## /system/applications/views/upload_form.php

	<!DOCTYPE html>
	<html>
	<head>
		<title>Upload Form</title>
		<style type="text/css">
			body {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<?php echo $error;?>
		<?php echo form_open_multipart('upload/do_upload'); ?>
			<input type="file" name="userfile" size="20" />
			<br />
			<input type="submit" value="upload" />
		</form>
	</body>
	</html>

## /system/applications/views/upload_success.php

	<!DOCTYPE html>
	<html>
	<head>
		<title>Successfully Uploaded</title>
		<style type="text/css">
			body {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<h2>Your file was successfully uploaded</h2>
		<p>
			<?php echo anchor('uploads/' . $upload_data['file_name'], 'Click here to view your upload') ?>
			<br />
			<?php echo anchor('upload', 'Upload Another File!'); ?>
		</p>
	</body>
	</html>

You will also need to create a directory in the root Codeigniter directory called "uploads" with permissions 777, as this is where the images will be stored (by default - you can change it).

<p>&nbsp;</p>

I will now work through all the code, showing you what everything does and how it works. I will assume you have a basic knowledge of how Codeigniter works; if you don't, I would suggest that you go read a tutorial!

## /system/application/controller/upload.php

	<?php

	class Upload extends Controller {
		function __construct() {
			parent::Controller();
			$this->load->helper(array('form', 'url'));
		}

		function index() {
			$this->load->view('upload_form', array('error' => ' ' ));
		}

The contents of the `__construct()` function is standard Codeigniter code - it just calls the parent constructor (giving it stuff like the `load` object) and loads the form and url helpers. `index()` is the default code - if no other function is specified, `index()` is ran. `index()` just displays the upload form.

		function do_upload() {
			$config = array(
				'upload_path'	=> './uploads/',
				'allowed_types'	=> 'gif|jpg|png',
				'max_size'		=> '100',
				'max_width'		=> '1024',
				'max_height'	=> '768',
				'encrypt_name'	=> true,
			);

The default configuration settings for the image upload script.

* `upload_path` - The path where the images will be uploaded to, relative to the Codeigniter root. Permissions must be 777, or you will just get an error.
* `allowed_types` - The types of image that are allowed.
* `max_size` - The maximum size of the image in KB.
* `max_width` / `max_height` - The maximum width and height of the image in pixels.
* `encrypt_name` - Boolean, whether to encrypt the file name or not.

			$this->load->library('upload', $config);

Load the upload library using the config settings defined above.

			if (!$this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('upload_form', $error);
			}

Attempt to upload the image. If the upload fails, it gets the error and displays it to the user. If it succeeds...

			else {
				$upload_data = $this->upload->data();
				$data_ary = array(
					'title'		=> $upload_data['client_name'],
					'file'		=> $upload_data['file_name'],
					'width'		=> $upload_data['image_width'],
					'height'	=> $upload_data['image_height'],
					'type'		=> $upload_data['image_type'],
					'size'		=> $upload_data['file_size'],
					'date'		=> time(),
				);

				$this->load->database();
				$this->db->insert('upload', $data_ary);

				$data = array('upload_data' => $upload_data);
				$this->load->view('upload_success', $data);
			}
		}
	}

If the upload succeeds, it works out what data it wants to insert into the database, then inserts it. It then loads the upload_success template file.

## The view files

The view files are both simple HTML, with a couple of Codeigniters features:

### anchor()

`anchor()` creates an anchor element based on the local site URL. It has three parameters:

	anchor($url, $text, $attributes)

The first parameter, `$url`, will be appended to the base url to produce the final url. It can either be an array or a string, so both of these examples would produce the same thing:

	<?php

	anchor('path/to/file.php');
	anchor(array('path', 'to', 'file.php'));

The second segment is the text of the link. If you leave it blank, the URL will be used.

	<?php

	anchor('file.php', 'Click here!');

This will produce `<a href="example.com/file.php">Click here!</a>`.

The third parameter can contain a list of attributes you would like added to the link. The attributes can be a simple string or an associative array:

	<?php

	anchor('file.php', 'Click here!', array('style' => 'color: red'));

That would produce `<a href="example.com/file.php" style="color: red">Click here!</a>`.

### form\_open\_multipart()

`form_open_multipart` is exactly the same as `form_open`, except it adds a multipart attribute, which is necessary to upload files with. `form_open` creates an opening form tag with your base url, and will also let you add form attributes and hidden fields. For example:

	<?php echo form_open_multipart('upload/do_upload'); ?>

This would print:

	<form method="post" action="http:/example.com/upload/do_upload">

Find out more about the form helper [here](http://codeigniter.com/user_guide/helpers/form_helper.html).

## What you could add to this script

The script I demonstrated to you is very basic, so here is a list of a few things you could do to it to improve it.

* Add a login system to it, or integrate it into someone else's login system
* Add a style
* Allow other file types, and handle them to make sure they're safe
* Resize the image to the correct size instead of erroring if they're too big

That's all for today, please share where you have used this code in a comment :)