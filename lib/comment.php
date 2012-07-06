<?php

if (!is_xhr(true) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
	echo 'Please don\'t access this page directly.';
	exit;
}

if (empty($_POST['slug']) || !is_readable('articles/' . $_POST['slug'] . '.md')) {
	echo 'Article not found.';
	exit;
}

$slug = $matches[2];

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['text'])) {
	echo 'Please specify all required forms.';
	exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	echo 'Invalid email address.';
	exit;
}

if (!empty($_POST['website'])) {
	$website = $_POST['website'];

	if (!filter_var($website, FILTER_VALIDATE_URL)) {
		echo 'Invalid website.';
		exit;
	}
} else {
	$website = '';
}

if (is_readable('articles/comments/' . $slug . '.json')) {
	$comments = file_get_contents('articles/comments/' . $slug . '.json');
	$comments = json_decode($comments);
} else {
	$comments = array();
}

$comment = array(
	'author'	=> $_POST['name'],
	'email'		=> $_POST['email'],
	'website'	=> $website,
	'text'		=> $_POST['text'],
	'date'		=> time(),
);
$comments[] = $comment;

$count = count($comments);
$comments = json_encode($comments);
file_put_contents('articles/comments/' . $slug . '.json', $comments);

$comment['text'] = $markdownParser->transformMarkdown(htmlspecialchars($comment['text']));
$comment['date'] = date('jS M Y \a\t h:i:s A', $comment['date']);
echo json_encode($comment);

// Update comments.json
$comments_info = file_get_contents('articles/comments/comments.json');
$comments_info = json_decode($comments_info, true);
$comments_info[$slug] = $count;
$comments_info = json_encode($comments_info);
file_put_contents('articles/comments/comments.json', $comments_info);

if (DEBUG) {
	exit;
}

$subject = 'New comment on lynx.io';
$message = <<<EOF
New comment left on lynx.io:

Author: {$_POST['name']}
Email: {$_POST['email']}
IP: {$_SERVER['REMOTE_ADDR']}
Website: $website
Body:

{$_POST['text']}
EOF;

mail($config['email'], $subject, $message, 'From: ' . $config['email']);
