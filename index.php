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
	'tags_link'		=> $config['site_url'] . '/tag',
	'site'			=> array(
		'name'	=> 'lynxphp',
		'url'	=> $config['site_url'],
	),
);

if (empty($_SERVER['PATH_INFO'])) {
	include('lib/index.php');
} else if (preg_match('/\/([a-z]+)\/([a-z0-9-_]+)\/?/i', $_SERVER['PATH_INFO'], $matches)
		&& is_readable('lib/' . $matches[1] . '.php')) {
	include('lib/' . $matches[1] . '.php');
} else {
	throw404();
}

function throw404() {
	global $tmpl_vars, $twig;

	header('HTTP/1.0 404 Not Found');
	$twig->display('404.twig.html', $tmpl_vars);
}
