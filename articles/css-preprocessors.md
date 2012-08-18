<info>
title: CSS Preprocessors
author: callumacrae
date: 1345308935
tags: css, less, sass, scss, preprocessor
summary: CSS preprocessors such as LESS and Sass extend CSS, adding additional features such as variables, nesting and mixings to the language, making it a lot easier to write and maintain. In this articl, I will be exploring the advantages and disadvantages of using a preprocessor and some features that the meain two preprocessors offer.
</info>

CSS preprocessors such as LESS and Sass extend CSS, adding additional features such as variables, nesting and mixins to the language, making it a lot easier to write and maintain. In this article, I will be exploring the advantages and disadvantages of using a preprocessor and some features that the main two preprocessors offer.

The two main preprocessors are LESS - you can guess where the name comes from - and Sass (Syntactically Awesome Stylesheets). Sass has two syntaxes, SCSS (Sassy CSS) and the old "indented syntax". I will be using SCSS in this article, and I don't like the indented syntax: it basically just removes the parentheses and semi-colons, and is very similar to SCSS. Both are pretty similar, largely offer the same features, and have similar syntaxes.

## Features

In this section, I will be exploring some of the features that LESS and SCSS offer.

### Nesting

When writing usual CSS, it is common to have to use selectors like these:

	#foo .bar p {
		color: red;
	}

	#foo .bar p span {
		color: blue;
	}

LESS and SCSS allow you to nest the selectors within each other (they both use the same syntax for basic nesting):

	#foo .bar p {
		color: red;

		span {
			color: blue;
		}
	}

It looks a lot better, is a lot DRYer, and is more maintainable.

Both allow you to refer to the parent element (for example, to nest pseudoclasses like `:hover`) using the same syntax:

	a {
		color: red;
		&:hover {
			color: blue;
		}

		&.test {
			color: orange;
			&:hover {
				color: green;
			}
		}
	}

That would produce something like the following:

	a {
		color: red;
	}

	a:hover {
		color: blue;
	}

	a.test {
		color: orange;
	}

	a.test:hover {
		color: green;
	}

SCSS (but not LESS) also allows you to nest properties. I'm still not sure whether I'm a huge fan of this yet though, as it isn't too readable:

	img {
		border: {
			style: solid;

			left: {
				width: 2px;
				color: red;
			}

			right: {
				width: 3px;
				color: blue;
			}
		}
	}

That will compile down to create something like the following CSS:

	img {
		border-style: solid;

		border-left-width: 2px;
		border-left-color: red;

		border-right-width: 3px;
		border-right-color: blue;
	}


### Variables

Variables are another popular feature of both languages. They use slightly different syntaxes - variables in LESS are prefixed with an ampersand while variables in SCSS are prefixed with a dollar sign - but they behave in similar ways.

To declare a variable in LESS:

	@color: orange;
	a {
		color: @color;
	}

And in SCSS:

	$color: orange;
	a {
		color: $color;
	}

You can perform arithmetic operations (+, -, /, * and %) with these variables - you can even add variables with units or colours together:

	@color: orange;
	a {
		color: @color + #111;
	}

Both languages have some built in functions which allow you to manipulate colours:

	@color: orange;
	a {
		color: darken(@color, 30%);
		background-color: lighten(@color, 20%);
	}

Check out the tutorials and references for LESS and SCSS to see the full list of functions.

SCSS, but not LESS, allows you to interpolate variables into property names and selectors:

	$name: test;
	$border-position: left;
	a.anchor-#{$name} {
		border-#{$border-position}-width: 2px;
	}


#### Scoping

Scoping works in both languages in a very similar manor to JavaScript: there is a scope per block, and you can access variables from parent blocks:

	$width: 2px;
	
	div.test {
		$color: red;
		border: $width $color solid;
	}

	div.test2 {
		border: $width $color solid; // Uh-oh; $color is not defined!
	}


### Comments

Both LESS and SCSS extend the comments features of CSS a tad. Comments using the traditional CSS comment syntax - `/* this is a comment */` will remain as-is, but they also allow you to use double slash comments like in other languages, which will be stripped from the source:

	// This is a test comment
	a {
		color: red; // It is red
	}
	/* This comment will remain */

In both LESS and SCSS, this will be parsed to something like this:

	a {
		color: red;
	}
	/* This comment will remain */


### Mixins

Mixins are very similar to functions in other languages, and are an incredibly useful feature of both LESS and SCSS, especially if you're working with CSS3 and browser prefixes. Traditionally, you would have to write something like the following to get a border radius in all browsers that support `border-radius`:

	div.test {
		border: 1px black solid;

		border-radius: 20px;
		-webkit-border-radius: 20px;
		-moz-border-radius: 20px;
	}

You can use a mixin to eliminate the need to write out all the browser prefixes every time you want to have a nice border:

	// LESS
	.round-corners (@radius: 5px) {
		border-radius: @radius;
		-webkit-border-radius: @radius;
		-moz-border-radius: @radius;
	}

	div.test {
		.round-corners(20px);
	}

	div.test2 {
		.round-corners; // Uses the default value of 5px
	}


	// SCSS
	@mixin round-corners ($radius: 5px) {
		border-radius: $radius;
		-webkit-border-radius: $radius;
		-moz-border-radius: $radius;
	}

	div.test {
		@include round-corners(20px);
	}

	div.test2 {
		@include round-corners; // Uses the default value of 5px
	}

LESS also has an extremely useful `@arguments` variable, which contains all the arguments given to the mixin:

	.box-shadow (@x: 0, @y: 0, @blur: 1px, @color: #000) {
		box-shadow: @arguments;
		-moz-box-shadow: @arguments;
		-webkit-box-shadow: @arguments;
	}

	div.test {
		.box-shadow(10px, 5px);
	}

That will result in the following CSS being produced:

	div.test {
		box-shadow: 10px 5px 1px #000;
		-moz-box-shadow: 10px 5px 1px #000;
		-webkit-box-shadow: 10px 5px 1px #000;
	}

SCSS supports "variable arguments": if you don't know how many arguments a mixin is accepting (or if you just want to accept a variable number of arguments), then you can use this feature to do it:

	@mixin round-corners ($radius...) {
		border-radius: $radius;
		-webkit-border-radius: $radius;
		-moz-border-radius: $radius;
	}

	div.test {
		@include round-corners(20px);
	}

	div.test2 {
		@include round-corners(10px 20px);
	}

That would produce something like the following CSS:

	div.test {
		border-radius: 20px;
		-webkit-border-radius: 20px;
		-moz-border-radius: 20px;
	}

	div.test2 {
		border-radius: 10px 20px;
		-webkit-border-radius: 10px 20px;
		-moz-border-radius: 10px 20px;
	}


### Control / Guard Expressions

Control is an area where LESS and SCSS differ massively. Say you want a mixin that accepts two arguments; whether to make the colour lighter or darker, and the colour itself. Within the function, you would need to call two different functions. I'll split this section into two subsections, one for LESS and one for SCSS.

#### LESS

With LESS, there are two ways you can do this; you can use either pattern-matching, or guard expressions. Pattern-matching is fairly self explanatory, and if you're familiar with functional programming then you will have met guards before.

Pattern matching works like this:

	.change (dark, @color) {
		color: darken(@color, 20%);
	}

	.change (light, @color) {
		color: lighten(@color, 10%);
	}

	@switch: dark;
	div.test {
		.change(@switch, orange);
	}

Then, if `@switch` equals "dark", the colour of `div.test` will be 20% darker than orange. If, however, we change `@switch` to "light", the colour of `div.test` will be 10% *lighter* than orange.

To do the same with a guarded mixin, we would use the following:

	.change (@color) when (@switch = dark) {
		color: darken(@color, 20%);
	}

	.change (@color) when (@switch = light) {
		color: lighten(@color, 10%);
	}

	@switch: dark;
	div.test {
		.change(orange);
	}

It's fairly self-explanatory, and behaves in exactly the same way that pattern matching does.

There are some other features available in pattern matching and guarded mixins in LESS, check out the documentation for them.

#### SCSS

SCSS does not have pattern matching and guarded mixins, it instead has control directives such as if statements and while loops. I am not going to cover them all here, just the if statement.

The if statement works in exactly the same manner that it does in other languages, but with a slightly different syntax. To implement the functionality we used above, we can use the following:

	.change ($switch, $color) {
		@if $switch == dark {
			color: darken($color, 20%);
		} @else if $switch == light {
			color: lighten($color, 10%);
		}
	}

	$switch: dark;
	div.test {
		.change($switch, orange);
	}

That behaves and outputs the same as the LESS code above.


### Importing LESS / SCSS files

In CSS, you can use the `@import` statement to import other stylesheets into your stylesheet. It isn't used much as it adds an extra HTTP request, which slows down the page load quite a lot.

You can use `@import` with LESS and SCSS, and it will behave slightly differently to if you use CSS alone. Again, there are a couple differences between LESS and SCSS, but nothing too major. Using `@import` to import other .less or .scss files will import the code directly into that file, and will also parse it as LESS or SCSS. For example:

main.less:

	@import "mixins";

	div.test {
		.border-radius(20px);
	}

mixins.less:

	.border-radius(@radius: 5px) {
		border-radius: @radius;
                -webkit-border-radius: @radius;
                -moz-border-radius: @radius;
        }

And that will be parsed into the following:

	div.test {
		border-radius: 20px;
		-webkit-border-radius: 20px;
		-moz-border-radius: 20px;
	}

You'll have noticed that I didn't specify the file extension for that import. You don't have to with SCSS, either - it just looks a bit nicer and removes some redundency from the code - it's fairly obvious that if you don't specify the extension that you want the `.less` or `.scss` file.

If you import a CSS file (for example, using `@import "print.css";`), it will remain as the `@import` statement in the parsed CSS.


### Looping

Looping can be a very useful feature - for example, to calculate the widths of a 12 column layout. With LESS, you can use recursion to run some code multiple times, while with SCSS you can just use a `@for` or `@while` loop (for this example, we'll be using a `@for` loop).

In LESS, we use two different mixins with pattern matching. When `@count` is between 12 and 1 (inclusive), it calls itself, decrementing `@count` by one. When it hits zero, a different mixin is called, which stops the loop.

	.cols-mixin (0) {}

	.cols-mixin (@i) when (@i > 0) {
		(~".cols-@{i}") {
			width: @i * 80;
		}
		.cols-mixin(@i - 1);
	}

	.cols-mixin(12);

In SCSS, we just use a for loop (it's a lot easier than in LESS):

	@for $i from 1 through 12 {
		.cols-#{$i} {
			width: $i * 80;
		}
	}

The SCSS syntax for this is far, far easier, and both are equally powerful.

Tangent: The examples above aren't too practical, as you want padding between the columns. For a full example of a 12 column grid, check out a library I wrote [here](https://github.com/callumacrae/960/blob/master/less/960.less).


### Other Miscellaneous Features

There are a couple miscellaneous, but important, features of both languages which are too small for their own section but too important to be left out of the article.

#### Escaping

Sometimes you may need to use invalid or proprietary syntax, such as Internet Explorer's old `filter` syntax. The LESS compiler won't like this (although the SCSS compiler doesn't mind), so you have to escape it using the following syntax:

	div.test {
		filter: ~"ms:alwaysHasItsOwnSyntax.For.Stuff()";
	}

The following will be output as expected:

	div.test {
		filter: ms:alwaysHasItsOwnSyntax.For.Stuff();
	}

#### JavaScript Evaluation

Another nifty feature that LESS has (but SCSS unfortunately doesn't) is that you can evaluate JavaScript using backticks:

	@string: `"DaRK".toLowerCase()`;

This isn't mind-boggling useful, except that if you're parsing the LESS client-side (which you shouldn't be) then you can access stuff like the height of the window, which can sometimes be useful.

#### SCSS's Interactive Shell

SCSS has an interactive shell, which allows you to experiment with evaluating code before you chuck it into your stylesheets. From the SCSS documentation:

	$ sass -i
	>> "Hello, Sassy World!"
	"Hello, Sassy World!"
	>> 1px + 1px + 1px
	3px
	>> #777 + #777
	#eeeeee
	>> #777 + #888
	white


## Advantages and disadvantages of using a preprocessor

The above was no means a complete list of every feature in LESS and SCSS, because this isn't a tutorial on those two preprocessors. It was merely to demonstrate a set of features that each of them contains, and to give you a basic idea of which you prefer if you decide that you want to use a preprocessor. LESS and SCSS are also not the only preprocessors; while I believe that they are definitely far superior to any of the others, there are others out there and people do use and prefer them. However, the majority of those features are usually the base features of other preprocessors.

There are many advantages and disadvantages of using a preprocessor, some of which I will highlight below.

### Advantages

* **It is a lot easier to write and maintain.** Due to the added features - especially nesting, variables and mixins - it is a lot easier to write than CSS alone. Instead of copying and pasting several different colour hexes about, you can define them at the top of that page and just write, say, `@orange` to get your custom shade of orange. This is also a lot easier to maintain - if you want to change the colours, you only have to change the one variable and it'll change all of them. Sure, you can use find and replace on your IDE, but this way is a lot easier.
* **It is more readable.** Some features of preprocessors, especially nesting, make your code a lot easier to read. You don't have to read a long chain of selectors whenever you want to see what something is pointing to, you just have to see what block it is in - or if you IDE supports or has a plugin for the preprocessor you're using, it might make it even easer for you.
* **They usually have great documentation.** SCSS has extremely comprehensive documentation covering every aspect of the language, and LESS also has fairly good documentation - although not quite as thorough as SCSS's. It is easy to find out how to do stuff, and I believe that it is usually the same for other preprocessors, too.
* **It is easier to add support for other browsers later.** Mixins make adding support for other browsers as they add more features later a lot easier. Say I need to add an `-o-border-radius` to my code wherever there is a border radius - with a preprocessor, I only need to change the one mixin. With CSS, I have to go through and change every instance by hand.
* **It can be a lot easier to debug.** If there is an error in your CSS (say, you spelled a property wrong), you will usually get no warning whatsoever. With a preprocessor, it will error when you attempt to compile your code.
* **They are easy to learn.** There is practically no learning curve in learning a preprocessor such as LESS or SCSS. Both of those examples have one page tutorials which explain nearly everything about the language, and the entire page can be read and digested in under ten minutes, in my experience. The languages don't tend to change much, so you don't have to rewrite your code on every new release or keep learning new features.
* **CSS is also valid LESS / SCSS.** You don't have to convert all your existing CSS over to LESS or SCSS (or whatever you choose) - as the languages were based in CSS, they don't mind if you just use normal CSS. This is good for other reasons - if you're copying in libraries, you can import the files in without having to change to LESS / SCSS or have multiple files. Obviously, if you use Sasses old indent syntax, you will need to convert your code over.

### Disadvantages

* **Your code needs parsing.** If you're using a preprocessor, then you can't just drop your code into your page and expect it to work, it needs parsing. This isn't usually a big problem - both LESS and SCSS, and I imagine the other preprocessors, provide applications (or have applications available) which will watch the relevant files for changes, and compile them whenever it sees that you have changed the file.
* **Client-side parsing is a bad feature.** LESS and a couple other preprocessors allow you to include your LESS file directly from your HTML, and then include a JavaScript file which will parse the LESS and insert it into the page. This is a pretty bad feature for live sites - if a user disables JavaScript or just uses an older browser that doesn't support it, you've just lost all your CSS. You're also relying on the JavaScript file to work in every browser - with pure CSS or server-side parsed LESS, you don't have to.
* **Some preprocessors are ugly.** For example, let's take Sasses old indent syntax: basically, all it does it remove semi-colons and parentheses and you have to use indents instead (which you should really be using anyway). I don't like this syntax at all, and it doesn't allow you to use normal CSS; you have to convert your code over.
