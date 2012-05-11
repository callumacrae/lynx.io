<?php

$page = $matches[1];

if (is_readable('cache/pages/' . $page . '.json')) {
	$info = file_get_contents('cache/pages/' . $page . '.json');
	$info = json_decode($info, true);

	$raw_body = file_get_contents('pages/' . $page . '.md');
	if ($raw_body === $info['raw_body']) {
		$tmpl_vars['page'] = $info;
		$tmpl_vars['page_title'] = $info['title'];
		$twig->display('page.twig.html', $tmpl_vars);
		$page = false;
	}
}

if ($page && is_readable('pages/' . $page . '.md')) {
	$body = file_get_contents('pages/' . $page . '.md');
	$raw_body = $body;

	$body = explode("\n</info>\n", $body);
	$info = explode("\n", $body[0]);
	unset($info[0]);

	foreach ($info as $key => $value) {
		$value = explode(': ', $value, 2);
		$info[$value[0]] = $value[1];
		unset($info[$key]);
	}

	$info['raw_body'] = $raw_body;
	$info['body'] = $markdownParser->transformMarkdown($body[1]);

	// Cache
	file_put_contents('cache/pages/' . $page . '.json', json_encode($info));

	$tmpl_vars['page'] = $info;
	$tmpl_vars['page_title'] = $info['title'];
	$twig->display('page.twig.html', $tmpl_vars);
} else if ($page) {
	throw404();
}
