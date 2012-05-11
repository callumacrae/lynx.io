<?php

$slug = $matches[2];

if (is_readable('cache/articles/' . $slug . '.json')) {
	$info = file_get_contents('cache/articles/' . $slug . '.json');
	$info = json_decode($info, true);

	$raw_body = file_get_contents('articles/' . $slug . '.md');
	if ($raw_body === $info['raw_body']) {
		if (is_readable('authors/' . $info['author'] . '.json')) {
			$author = file_get_contents('authors/' . $info['author'] . '.json');
			$info['author'] = json_decode($author);
		} else {
			unset($info['author']);
		}

		$tmpl_vars['article'] = $info;
		$tmpl_vars['page_title'] = $info['title'];
		$twig->display('article.twig.html', $tmpl_vars);
		$slug = false;
	}
}

if ($slug && is_readable('articles/' . $slug . '.md')) {
	$body = file_get_contents('articles/' . $slug . '.md');
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
	$info['tags'] = explode(', ', $info['tags']);

	if (is_readable('authors/' . $info['author'] . '.json')) {
		$author = file_get_contents('authors/' . $info['author'] . '.json');
		$info['author'] = json_decode($author);
	} else {
		unset($info['author']);
	}

	// Cache
	file_put_contents('cache/articles/' . $slug . '.json', json_encode($info));

	$tmpl_vars['article'] = $info;
	$tmpl_vars['page_title'] = $info['title'];
	$twig->display('article.twig.html', $tmpl_vars);
} else if ($slug) {
	throw404();
}
