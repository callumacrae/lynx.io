<info>
title: Using preg_replace as a word censor or for smilies
author: callumacrae
date: 1294034400
tags: php, scripts, preg_replace, regex
summary: In this article I will be demonstrating a basic word censor / smilie parser that you can use on your website. Firstly I will give you the code, then I will explain how to use it, then I will tell you how it works.
</info>

In this article I will be demonstrating a basic word censor / smilie parser that you can use on your website. First I will give you the code, then I will explain how to use it, and finally I will tell you how it works.

The code:

	<?php

	function parse($text, $smile = true, $swears = true) {
		// Checks to see whether word censoring is enabled
		// If it is, censor the words in the array $words
		if ($swears) {
			$words = array(
				'badword' => 'bad****',
				'baad' => '****',
			);
			$text = preg_replace(array_keys($words), $words, $text);
		}

		// Checks to see whether smilies are enabled
		// If it is, use the smilies specifies in the array $smilies
		if ($smile) {
			$smilies = array(
				':)' => 'smile.png',
				':D' => 'happy.png',
				':(' => 'sad.png',
			);
			$image_location = '/images/smilies/';

			foreach($smilies as $value) {
				$smilies_img[] = $image_location . $value;
			}

			$text = preg_replace(array_keys($smilies), $smilies_img, $text);
		}

		return $text;
	 	}

Using this function is simple:

`parse($text_to_parse)` or `parse($text_to_parse, 0)` if you want to disable smilies, or `parse($text_to_parse, 1, 0)` to disable the word censor.

## How it works

The code is in two sections - the word censor is in the first part of the code, while the smilies are in the second part of code. The word censor is much simpler than the smilie converter, because the smilie converter has to cycle through all the smilies specifying a location where the images are stored (specified in the `$image_location` variable). It’s pretty self explanatory.
