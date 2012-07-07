<?php

$slug = $matches[2];

// Get comments
if (!empty($_GET['timestamp']) || is_xhr(true)) {
	$timestamp = (int) $_GET['timestamp'];

	if ($timestamp < time() - 68400) {
		echo '"Invalid time"';
		exit;
	}

	$newComments = array();
	foreach (get_comments($slug) as $comment) {
		if ($comment->date > $timestamp) {
			$newComments[] = array(
				'author'	=> $comment->author,
				'website'	=> $comment->website,
				'date'		=> date('jS M Y \\a\\t h:i:s A', $comment->date),
				'text'		=> $comment->text
			);
		}
	}

	echo json_encode($newComments);
	exit;
}

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
		$tmpl_vars['comments'] = get_comments($slug);

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
	
	$articleimages = $config['site_url'] . '/assets/imgs/' . $slug;
	$info['body'] = $markdownParser->transformMarkdown($body[1]);
	$info['body'] = str_replace('{{ articleimages }}', $articleimages, $info['body']);
	
	$info['tags'] = explode(', ', $info['tags']);
	$info['slug'] = $slug;

	// Cache
	file_put_contents('cache/articles/' . $slug . '.json', json_encode($info));

	if (is_readable('authors/' . $info['author'] . '.json')) {
		$author = file_get_contents('authors/' . $info['author'] . '.json');
		$info['author'] = json_decode($author);
	} else {
		unset($info['author']);
	}

	$tmpl_vars['article'] = $info;
	$tmpl_vars['comments'] = get_comments($slug);

	$tmpl_vars['page_title'] = $info['title'];
	$twig->display('article.twig.html', $tmpl_vars);
} else if ($slug) {
	throw404();
}

/**
 * Gets all of an article's comments.
 *
 * @param string $slug The slug of the article to get the comments for.
 * @return array The comments
 */
function get_comments($slug) {
	global $markdownParser;

	if (is_readable('articles/comments/' . $slug . '.json')) {
		$comments = file_get_contents('articles/comments/' . $slug . '.json');
		$comments = json_decode($comments);

		foreach ($comments as $comment) {
			$comment->text = htmlspecialchars($comment->text);
			
			// Unescape quotes
			$comment->text = preg_replace('/(^|\n)&gt;/', "\n>", $comment->text);
			
			// Unescape URLs
			$comment->text = preg_replace_callback('/&lt;(http:\/\/[^ ]+)&gt;/', function ($matches) {
				if (filter_var($matches[1], FILTER_VALIDATE_URL)) {
					return '<' . $matches[1] . '>';
				} else {
					return '&lt;' . $matches[1] . '&gt;';
				}
			}, $comment->text);
			
			$comment->text = $markdownParser->transformMarkdown($comment->text);
		}

		return $comments;
	}

	return array();
}
