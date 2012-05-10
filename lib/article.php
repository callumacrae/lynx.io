<?php

$slug = $matches[2];

if (is_readable('articles/' . $slug . '.md')) {
	$body = file_get_contents('articles/' . $slug . '.md');

	$body = explode("\n</info>\n", $body);
	$info = explode("\n", $body[0]);
	unset($info[0]);

	foreach ($info as $key => $value) {
		$value = explode(': ', $value, 2);
		$info[$value[0]] = $value[1];
		unset($info[$key]);
	}

	$info['body'] = $markdownParser->transformMarkdown($body[1]);
	$info['tags'] = explode(', ', $info['tags']);

	$tmpl_vars['article'] = $info;
	$tmpl_vars['page_title'] = $info['title'];
	$twig->display('article.twig.html', $tmpl_vars);
} else {
	throw404();
}
