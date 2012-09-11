<info>
title: Colors in CSS
author: callumacrae
date: %date%
tags: css, colors
summary: Colors are a vital part of CSS, allowing the user to change the color of text and borders, and the background colors of elements such as text and divs - a fairly major part of design. In this article, I will explain the different syntaxes available - the obvious two are string colours (such as "red" and "black"), and Hex colours (such as `#ef0000`), and I will also cover RGB and HSL colours, both of which are possible in CSS.
</info>

Colors are a vital part of CSS, allowing the user to change the color of text and borders, and the background colors of elements such as text and divs - a fairly major part of design. In this article, I will explain the different syntaxes available - the obvious two are string colours (such as "red" and "black"), and Hex colours (such as `#ef0000`), and I will also cover RGB and HSL colours, both of which are possible in CSS.


## Color names

There are 147 color names defined in the HTML and CSS color specifications which allow you to just type the name of the colour to get the colour. This is a lot easier and a lot more readable.

Here is a table of all the color names in CSS:

<table>
	<tr>
		<td style="background-color: aliceblue">aliceblue</td>
		<td style="background-color: antiquewhite">antiquewhite</td>
		<td style="background-color: aqua">aqua</td>
		<td style="background-color: aquamarine">aquamarine</td>
		<td style="background-color: azure">azure</td>
		<td style="background-color: beige">beige</td>
		<td style="background-color: bisque">bisque</td>
		<td style="background-color: black">black</td>
	</tr>
	<tr>
		<td style="background-color: blanchedalmond">blanchedalmond</td>
		<td style="background-color: blue">blue</td>
		<td style="background-color: blueviolet">blueviolet</td>
		<td style="background-color: brown">brown</td>
		<td style="background-color: burlywood">burlywood</td>
		<td style="background-color: cadetblue">cadetblue</td>
		<td style="background-color: chartreuse">chartreuse</td>
		<td style="background-color: chocolate">chocolate</td>
	</tr>
	<tr>
		<td style="background-color: coral">coral</td>
		<td style="background-color: cornflowerblue">cornflowerblue</td>
		<td style="background-color: cornsilk">cornsilk</td>
		<td style="background-color: crimson">crimson</td>
		<td style="background-color: cyan">cyan</td>
		<td style="background-color: darkblue">darkblue</td>
		<td style="background-color: darkcyan">darkcyan</td>
		<td style="background-color: darkgoldenrod">darkgoldenrod</td>
	</tr>
	<tr>
		<td style="background-color: darkgray">darkgray</td>
		<td style="background-color: darkgreen">darkgreen</td>
		<td style="background-color: darkkhaki">darkkhaki</td>
		<td style="background-color: darkmagenta">darkmagenta</td>
		<td style="background-color: darkolivegreen">darkolivegreen</td>
		<td style="background-color: darkorange">darkorange</td>
		<td style="background-color: darkorchid">darkorchid</td>
		<td style="background-color: darkred">darkred</td>
	</tr>
	<tr>
		<td style="background-color: darksalmon">darksalmon</td>
		<td style="background-color: darkseagreen">darkseagreen</td>
		<td style="background-color: darkslateblue">darkslateblue</td>
		<td style="background-color: darkslategray">darkslategray</td>
		<td style="background-color: darkturquoise">darkturquoise</td>
		<td style="background-color: darkviolet">darkviolet</td>
		<td style="background-color: deeppink">deeppink</td>
		<td style="background-color: deepskyblue">deepskyblue</td>
	</tr>
	<tr>
		<td style="background-color: dimgray">dimgray</td>
		<td style="background-color: dodgerblue">dodgerblue</td>
		<td style="background-color: firebrick">firebrick</td>
		<td style="background-color: floralwhite">floralwhite</td>
		<td style="background-color: forestgreen">forestgreen</td>
		<td style="background-color: fuchsia">fuchsia</td>
		<td style="background-color: gainsboro">gainsboro</td>
		<td style="background-color: ghostwhite">ghostwhite</td>
	</tr>
	<tr>
		<td style="background-color: gold">gold</td>
		<td style="background-color: goldenrod">goldenrod</td>
		<td style="background-color: gray">gray</td>
		<td style="background-color: green">green</td>
		<td style="background-color: greenyellow">greenyellow</td>
		<td style="background-color: honeydew">honeydew</td>
		<td style="background-color: hotpink">hotpink</td>
		<td style="background-color: indianred">indianred</td>
	</tr>
	<tr>
		<td style="background-color: indigo">indigo</td>
		<td style="background-color: ivory">ivory</td>
		<td style="background-color: khaki">khaki</td>
		<td style="background-color: lavender">lavender</td>
		<td style="background-color: lavenderblush">lavenderblush</td>
		<td style="background-color: lawngreen">lawngreen</td>
		<td style="background-color: lemonchiffon">lemonchiffon</td>
		<td style="background-color: lightblue">lightblue</td>
	</tr>
	<tr>
		<td style="background-color: lightcoral">lightcoral</td>
		<td style="background-color: lightcyan">lightcyan</td>
		<td style="background-color: lightgoldenrodyellow">lightgoldenrodyellow</td>
		<td style="background-color: lightgray">lightgray</td>
		<td style="background-color: lightgreen">lightgreen</td>
		<td style="background-color: lightpink">lightpink</td>
		<td style="background-color: lightsalmon">lightsalmon</td>
		<td style="background-color: lightseagreen">lightseagreen</td>
	</tr>
	<tr>
		<td style="background-color: lightskyblue">lightskyblue</td>
		<td style="background-color: lightslategray">lightslategray</td>
		<td style="background-color: lightsteelblue">lightsteelblue</td>
		<td style="background-color: lightyellow">lightyellow</td>
		<td style="background-color: lime">lime</td>
		<td style="background-color: limegreen">limegreen</td>
		<td style="background-color: linen">linen</td>
		<td style="background-color: magenta">magenta</td>
	</tr>
	<tr>
		<td style="background-color: maroon">maroon</td>
		<td style="background-color: mediumaquamarine">mediumaquamarine</td>
		<td style="background-color: mediumblue">mediumblue</td>
		<td style="background-color: mediumorchid">mediumorchid</td>
		<td style="background-color: mediumpurple">mediumpurple</td>
		<td style="background-color: mediumseagreen">mediumseagreen</td>
		<td style="background-color: mediumslateblue">mediumslateblue</td>
		<td style="background-color: mediumspringgreen">mediumspringgreen</td>
	</tr>
	<tr>
		<td style="background-color: mediumturquoise">mediumturquoise</td>
		<td style="background-color: mediumvioletred">mediumvioletred</td>
		<td style="background-color: midnightblue">midnightblue</td>
		<td style="background-color: mintcream">mintcream</td>
		<td style="background-color: mistyrose">mistyrose</td>
		<td style="background-color: moccasin">moccasin</td>
		<td style="background-color: navajowhite">navajowhite</td>
		<td style="background-color: navy">navy</td>
	</tr>
	<tr>
		<td style="background-color: oldlace">oldlace</td>
		<td style="background-color: olive">olive</td>
		<td style="background-color: olivedrab">olivedrab</td>
		<td style="background-color: orange">orange</td>
		<td style="background-color: orangered">orangered</td>
		<td style="background-color: orchid">orchid</td>
		<td style="background-color: palegoldenrod">palegoldenrod</td>
		<td style="background-color: palegreen">palegreen</td>
	</tr>
	<tr>
		<td style="background-color: paleturquoise">paleturquoise</td>
		<td style="background-color: palevioletred">palevioletred</td>
		<td style="background-color: papayawhip">papayawhip</td>
		<td style="background-color: peachpuff">peachpuff</td>
		<td style="background-color: peru">peru</td>
		<td style="background-color: pink">pink</td>
		<td style="background-color: plum">plum</td>
		<td style="background-color: powderblue">powderblue</td>
	</tr>
	<tr>
		<td style="background-color: purple">purple</td>
		<td style="background-color: red">red</td>
		<td style="background-color: rosybrown">rosybrown</td>
		<td style="background-color: royalblue">royalblue</td>
		<td style="background-color: saddlebrown">saddlebrown</td>
		<td style="background-color: salmon">salmon</td>
		<td style="background-color: sandybrown">sandybrown</td>
		<td style="background-color: seagreen">seagreen</td>
	</tr>
	<tr>
		<td style="background-color: seashell">seashell</td>
		<td style="background-color: sienna">sienna</td>
		<td style="background-color: silver">silver</td>
		<td style="background-color: skyblue">skyblue</td>
		<td style="background-color: slateblue">slateblue</td>
		<td style="background-color: slategray">slategray</td>
		<td style="background-color: snow">snow</td>
		<td style="background-color: springgreen">springgreen</td>
	</tr>
	<tr>
		<td style="background-color: steelblue">steelblue</td>
		<td style="background-color: tan">tan</td>
		<td style="background-color: teal">teal</td>
		<td style="background-color: thistle">thistle</td>
		<td style="background-color: tomato">tomato</td>
		<td style="background-color: turquoise">turquoise</td>
		<td style="background-color: violet">violet</td>
		<td style="background-color: wheat">wheat</td>
	</tr>
	<tr>
		<td style="background-color: white">white</td>
		<td style="background-color: whitesmoke">whitesmoke</td>
		<td style="background-color: yellow">yellow</td>
		<td style="background-color: yellowgreen">yellowgreen</td>
	</tr>
</table>

They can be used in any CSS property that accepts a colour value:

	color: white;
	background-color: black;
	border: 2px red solid;

Remember that while it is "grey" in en-GB, CSS uses en-US (hence "color"). You should try to get into the habit of using "gray".


## RGB colors

This type of color value is less used than color names and hex colors, but it helps explain hex colors so I'll explain them before. The CSS RGB function allows you to specify the red, blue, and green values of a colour (similar to like in a graphic package such as PhotoShop). For example, the following colours are equal to the color names besides them:

	color: rgb(255, 0, 0); /* red */
	color: rgb(0, 255, 0); /* lime */
	color: rgb(0, 0, 255); /* blue */

	color: rgb(0, 128, 0); /* green */
	color: rgb(0, 0, 0); /* black */
	color: rgb(255, 255, 255); /* white */
	color: rgb(128, 128, 128); /* gray */


The RGB function also allows you to specify the values as a percentage of 255. For example, 0% would be 0, 100% would be 255, and 50% would be 128:

	color: rgb(100%, 0%, 0%); /* red */
	color: rgb(0%, 50%, 0%); /* green */


### RGBA colors

In addition to the rgb function, an `rgba` function was introduced in CSS3. Pretty much all browsers but IE8 and below support it. It allows you, in addition to specifying the rgb values of the color, to specify an alpha transparency:

	background-color: rgba(255, 0, 0, 0.7);

That would set the background-color of whatever element is being selected to red, with a opacity of 0.7:

This text is *under* the div.

<div style="position: absolute; z-index: 20; margin-top: -50px; width: 200px; height: 70px; background-color: rgba(255, 0, 0, 0.7)"></div>

<span style="position: absolute; z-index: 21; display: block; margin-top: -20px">This text is <em>over</em> the div.</span>

<div style="height: 30px"></div>

## Hex colors

The other common type of CSS color is the hex value. Hexadecimal is base 16; 0x16 is 22, 0xF is 15, and 0xFF is 255. Hex colors accept three two-digit hexadecimal numbers with no spaces in between, where the first is red out of 255 (0xFF), the second is green out of 255, and the third is blue out of 255.

The following two CSS colors would be the same:

	#EFEFEF
	rgb(239, 239, 239)

They are case insensitive, meaning that you can write either `#efefef` or `#EFEFEF` (or even, for that matter, `#eFEfeF`; although that isn't too readable).

It is possible to shorten some hex colors to three digits. The following two are equivalent:

	#ffffff
	#fff

Note that `#fff` is not equal to `#0f0f0f`.


## HSL colors

The `hsl` function was introduced alongside the `rgba` function in CSS3, and has the same browser support.

The function takes three values. The first is the hue, a number between 0 and 360 (inclusive) which should be the number of degrees on the colour wheel. 0 and 360 are red, 120 is green, and 240 is blue - everything else is in between those. This can also be a percentage; 0% would be red, 33% would be green, and 66% would be blue.

The second value is the saturation as a percentage. 100% would be the full color, while 0% would be colorless.

Lightness, the third value, is also a percentage. 0% is black, 100% is white, and 50% is the color. Everything else is relative; 75% would be the light color, and 25% would be a darker color.

The following are all valid hsl values:

	color: hsl(0, 100%, 50%); /* red */
	color: hsl(120, 100%, 50%); /* lime */
	color: hsl(120, 50%, 50%); /* green */


### The hsla function

The `hsla` function, similar to the `rgba` function, allows you to specify the alpha transparency of the colour. The following would produce the same colour as in the previous transparency example:

	background-color: hsl(0, 100%, 50%, 0.7);


## Grayscale colors

A hint for the [Regex Tuesday Challenge on colors](http://callumacrae.github.com/regex-tuesday/challenge2.html) is that a grayscale color has the same red, green, and blue values. The following would be grayscale colors:

	#fff
	#efefef
	#1f1f1f
	rgb(0, 0, 0)
	rgba(14, 14, 14, 0.9)
	hsl(0, 0, 40%)
	hsl(0, 40%, 0%)






