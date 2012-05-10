<?php

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {

	$time = time();
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

	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		mail($config['email'], 'Contact via lynxphp contact form', $message, $headers);
		$tmpl_vars['contact_success'] = true;
	} else {
		$tmpl_vars['contact_failure'] = true;
	}
}

$twig->display('contact.twig.html', $tmpl_vars);
