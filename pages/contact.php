<?php

$tmpl_vars['contact_success'] = false;
if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {

	$time = time();
	$subject = 'Contact via lynx.io contact form';
	$message = <<<EOF
Contacted at $time.

From: {$_POST['name']} <{$_POST['email']}>

Body:
{$_POST['message']}
EOF;

	$headers = <<<EOF
From: {$config['email']}
Reply-To: {$_POST['email']}
EOF;

	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
			mail($config['email'], $subject, $message, $headers)) {
		$tmpl_vars['contact_success'] = true;
	} else {
		$tmpl_vars['contact_failure'] = true;
	}
}

if (is_xhr(true)) {
	$success = $tmpl_vars['contact_success'];
	echo $success ? '"Successfully sent"' : '"Failed to send"';
} else {
	$tmpl_vars['page_title'] = 'Contact';
	$twig->display('contact.twig.html', $tmpl_vars);
}
