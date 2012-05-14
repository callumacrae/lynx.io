<?php

set_time_limit(60);

require('config.php');
require('vendor/autoload.php');
use dflydev\markdown\MarkdownParser;
$markdownParser = new MarkdownParser();

$output = shell_exec('git pull origin master 2>&1');

preg_match_all('/create mode \d+ articles\/([a-z0-9_-]+)\.md/i', $output, $matches);
$articles = json_decode(file_get_contents('articles/articles.json'));

foreach ($matches[1] as $file) {
	$body = file_get_contents('articles/' . $file . '.md');
	$body = str_replace('%date%', time(), $body);
	file_put_contents('articles/' . $file . '.md', $body);

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
	$info['slug'] = $file;

	// Cache
	file_put_contents('cache/articles/' . $file . '.json', json_encode($info));

	$article = array(
		'title'		=> $info['title'],
		'slug'		=> $info['slug'],
		'author'	=> $info['author'],
		'date'		=> $info['date'],
		'tags'		=> $info['tags'],
		'summary'	=> $info['summary'],
	);

	array_unshift($articles, $article);

	echo "Added $file." . PHP_EOL;
}

file_put_contents('articles/articles.json', json_encode($articles));
