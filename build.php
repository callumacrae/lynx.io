<?php

set_time_limit(60);

require('config.php');
require('vendor/autoload.php');
use dflydev\markdown\MarkdownParser;
$markdownParser = new MarkdownParser();

$repo = 'https://' . $config['deploy_token'] . '@github.com/callumacrae/lynx.io.git';
$output = shell_exec("git pull origin master 2>&1");
echo $output;

$regex = '/create mode \d+ articles\/([a-z0-9_-]+)\.md/i';
$match = preg_match_all($regex, $output, $matches);

if ($match) {
	$articles = json_decode(file_get_contents('articles/articles.json'));
	$files = array();

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
		$filename = 'cache/articles/' . $file . '.json';
		file_put_contents($filename, json_encode($info));

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
		$files[] = $file;
	}

	file_put_contents('articles/articles.json', json_encode($articles));

	echo PHP_EOL . shell_exec('git commit -am "[auto] Deployed articles.

' . implode(PHP_EOL, $files) . '" && git push ' . $repo . ' master');
} else {
	echo PHP_EOL . 'No new articles.';
}
