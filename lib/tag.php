<?php

$all_articles = json_decode(file_get_contents('articles/articles.json'));
$articles = array();

foreach ($all_articles as $article) {
	if (in_array($matches[2], $article->tags)) {
		$articles[] = $article;
	}
}

$tmpl_vars['articles'] = $articles;
$twig->display('articles.twig.html', $tmpl_vars);
