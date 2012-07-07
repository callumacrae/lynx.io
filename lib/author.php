<?php

if (is_readable('authors/' . $matches[2] . '.json')) {
	$author = file_get_contents('authors/' . $matches[2] . '.json');
	$tmpl_vars['author_info'] = json_decode($author);
}

$articles = array();


if (is_xhr(true) && !empty($_GET['timestamp'])) {
	$timestamp = (int) $_GET['timestamp'];
	if ($timestamp < time() - 68400) {
		echo '"Invalid time"';
		exit;
	}

	foreach ($all_articles as $article) {
		if ($article->author === $matches[2] && $article->date > $timestamp) {
			$root = $config['site_url'];

			$newArticle = array(
				'title'		=> $article->title,
				'href'		=> $root . '/article/' . $article->slug,
				'date'		=> array(
					date('Y-m-d', $article->date),
					date('jS M Y', $article->date),
					$article->date
				),
				'summary'	=> $article->summary,
				'tags'		=> array()
			);

			foreach($article->tags as $tag) {
				$newArticle['tags'][$tag] = $root . '/tag/' . $tag;
			}

			$articles[] = $newArticle;
		}
	}

	echo json_encode($articles);
} else {
	foreach ($all_articles as $article) {
		if ($article->author === $matches[2]) {
			$articles[] = $article;
		}
	}

	if (is_xhr()) {
		echo count($articles);
	} else {
		$tmpl_vars['articles'] = $articles;
		$twig->display('articles.twig.html', $tmpl_vars);
	}
}
