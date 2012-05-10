<?php

$page = $matches[1];

if (is_readable('pages/' . $page . '.md')) {
	$body = file_get_contents('pages/' . $page . '.md');

	$body = explode("\n</info>\n", $body);
	$info = explode("\n", $body[0]);
	unset($info[0]);

	foreach ($info as $key => $value) {
		$value = explode(': ', $value, 2);
		$info[$value[0]] = $value[1];
		unset($info[$key]);
	}

	$info['body'] = $markdownParser->transformMarkdown($body[1]);

	$tmpl_vars['page'] = $info;
	$tmpl_vars['page_title'] = $info['title'];
	$twig->display('page.twig.html', $tmpl_vars);
} else {
	throw404();
}
