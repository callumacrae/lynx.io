<?php

$articles = array();

foreach ($all_articles as $article) {
	if (in_array(urldecode($matches[2]), $article->tags)) {
		$articles[] = $article;
	}
}

if (is_xhr(true)) {
	echo count($articles);
} else {
	$tmpl_vars['articles'] = $articles;
	$twig->display('articles.twig.html', $tmpl_vars);
}
