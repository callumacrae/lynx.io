<?php

if (is_readable('authors/' . $matches[2] . '.json')) {
	$author = file_get_contents('authors/' . $matches[2] . '.json');
	$tmpl_vars['author_info'] = json_decode($author);
}

$articles = array();

foreach ($all_articles as $article) {
	if ($article->author === $matches[2]) {
		$articles[] = $article;
	}
}

if (is_xhr(true)) {
	echo count($articles);
} else {
	$tmpl_vars['articles'] = $articles;
	$twig->display('articles.twig.html', $tmpl_vars);
}
