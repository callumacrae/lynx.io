<?php

$tmpl_vars['articles'] = $all_articles;

$twig->display('articles.twig.html', $tmpl_vars);
