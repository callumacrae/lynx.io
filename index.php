<?php
/**
 * lynxphp site
 *
 * Everything should go through this file: index.php/article/article-slug
 */

if (!is_writable('./cache')) {
	die('./cache is not writable');
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

// Global template stuff
$tmpl_vars = array(
	'assets_path'	=> $config['site_url'] . '/assets',
	'site'			=> array(
		'name'	=> 'lynxphp',
		'url'	=> $config['site_url'],
	),
);

if (empty($_SERVER['PATH_INFO'])) {
	$twig->display('index.twig.html', $tmpl_vars);
} else if (preg_match('/\/article\/([a-z0-9-_]+)\/?/i', $_SERVER['PATH_INFO'], $matches)) {
	$slug = $matches[1];

	if (is_readable('articles/' . $slug . '.md')) {
		$body = file_get_contents('articles/' . $slug . '.md');

		$body = explode("\n</info>\n", $body);
		$info = explode("\n", $body[0]);
		unset($info[0]);

		foreach ($info as $key => $value) {
			$value = explode(': ', $value, 2);
			$info[$value[0]] = $value[1];
			unset($info[$key]);
		}

		$info['body'] = $markdownParser->transformMarkdown($body[1]);

		$tmpl_vars['article'] = $info;
		$twig->display('article.twig.html', $tmpl_vars);
	} else {
		// Page not found
	}
} else {
	// Page not found
}
