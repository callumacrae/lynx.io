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

$path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
$path = str_replace($path, '', $_SERVER['REQUEST_URI']);

if (empty($path)) {
	include('lib/index.php');
} else if (preg_match('/([a-z]+)\/([a-z0-9-_]+)\/?/i', $path, $matches)
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
