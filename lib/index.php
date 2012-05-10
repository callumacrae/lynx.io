<?php

$articles = json_decode(file_get_contents('articles/articles.json'));
$tmpl_vars['articles'] = $articles;

$twig->display('articles.twig.html', $tmpl_vars);
