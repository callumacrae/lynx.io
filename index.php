<?php
/**
 * lynx.io site
 *
 * Everything should go through this file: index.php/article/article-slug
 */

if (!is_writable('./cache')) {
	die('./cache is not writable');
}
if (!is_writable('./articles/comments')) {
	die('./articles/comments is not writable');
}

if (DEBUG) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}

require('config.php');
require('vendor/autoload.php');
Twig_Autoloader::register();

use dflydev\markdown\MarkdownParser;
$markdownParser = new MarkdownParser();

$loader = new Twig_Loader_Filesystem('template');
$twig_config = array();
if (!DEBUG) {
	$twig_config['cache'] = 'cache';
}
$twig = new Twig_Environment($loader, $twig_config);

// Latest articles
$all_articles = json_decode(file_get_contents('articles/articles.json'));
$comments = json_decode(file_get_contents('articles/comments/comments.json'), true);
for ($i = 0; $i < count($all_articles); $i++) {
	$article = $all_articles[$i];
	$article->comments = isset($comments[$article->slug]) ? $comments[$article->slug] : 0;

	if ($i < 5) {
		$latest_articles[] = $all_articles[$i];
	}
}

// Global template stuff
$tmpl_vars = array(
	'assets_path'	=> $config['site_url'] . '/assets',
	'latest_articles'	=> $latest_articles,
	'site'			=> array(
		'name'	=> 'lynx.io',
		'url'	=> $config['site_url'],
	),
);

// Path
$path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

$pos = strpos($path, $_SERVER['REQUEST_URI']);
$path = substr($_SERVER['REQUEST_URI'], $pos + strlen($path));

//$path = str_replace($path, '', $_SERVER['REQUEST_URI']);

if (empty($path)) {
	include('lib/index.php');
} else if (preg_match('/([a-z]+)\/([^\/]+)\/?/i', $path, $matches)
		&& is_readable('lib/' . $matches[1] . '.php')) {
	include('lib/' . $matches[1] . '.php');
} else if (preg_match('/([a-z]+)\/?/i', $path, $matches)) {
	if (is_readable('pages/' . $matches[1] . '.php')) {
		include('pages/' . $matches[1] . '.php');
	} else if (is_readable('pages/' . $matches[1] . '.md')) {
		include('lib/page.php');
	} else {
		throw404();
	}
} else {
	throw404();
}

function throw404() {
	global $tmpl_vars, $twig;

	header('HTTP/1.0 404 Not Found');
	$twig->display('404.twig.html', $tmpl_vars);
}
