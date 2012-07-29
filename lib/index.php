<?php

if (!empty($_GET['timestamp']) && is_xhr(true)) {
	$timestamp = (int) $_GET['timestamp'];
	if ($timestamp < time() - 68400) {
		echo '"Invalid time"';
		exit;
	}

	$articles = array();
	foreach ($all_articles as $article) {
		if ($article->date > $timestamp) {
			$root = $config['site_url'];

			$newArticle = array(
				'title'		=> $article->title,
				'href'		=> $root . '/article/' . $article->slug,
				'date'		=> array(
					date('Y-m-d', $article->date),
					date('jS M Y', $article->date),
					$article->date,
				),
				'summary'	=> $article->summary,
				'tags'		=> array(),
			);

			foreach($article->tags as $tag) {
				$newArticle['tags'][$tag] = $root . '/tag/' . $tag;
			}

			$articles[] = $newArticle;
		}
	}

	echo json_encode($articles);
} else {
	$tmpl_vars['articles'] = $all_articles;
	$twig->display('articles.twig.html', $tmpl_vars);
}
