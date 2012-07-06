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
	echo $tmpl_vars['contact_success'] ? '"Successfully sent"' : '"Failed to send"';
} else {
	$twig->display('contact.twig.html', $tmpl_vars);
}
