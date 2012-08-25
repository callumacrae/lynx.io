<info>
title: Making a Simple Drawing Application using RaphaëlJS
author: callumacrae
date: %date%
tags: javascript, arrays, looping
summary: Raphaël is a library for working with vector graphics in JavaScript. It uses SVG, and boasts support for pretty much all browsers. In this tutorial, I'll be showing you how you can create a simple drawing application using Raphaël. It will just support basic line drawings, and you will be able to change the width and colour of the line.
</info>

<!-- can't put it in the header; sorry W3C! -->
<link rel="stylesheet" href="{{ articleimages }}/style.css" />

Raphaël is a library for working with vector graphics in JavaScript. It uses SVG, and boasts support for pretty much all browsers - Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+. Every object created is also a DOM object, meaning that you can treat them as such, adding event handlers the normal way.

In this tutorial, I'll be showing you how you can create a simple drawing application using Raphaël. It will just support basic line drawings, and you will be able to change the width and colour of the line. It will support all the browsers mentioned above, as I'm using jQuery to do stuff like event handling.

All the examples in this article are live, and using Raphaël. I'd advise against looking at the source for this article to see how I have done stuff, as I have changed it a bit so that I can get it into the page without it looking funny.

## Step one: setting up Raphaël

To set up Raphaël, put the following HTML onto your page (for non-HTML users, you'll want to add `type` attributes to the script tags):

	<div id="canvas"></div>
	<script src="raphael-min.js"></script>
	<script>
		var canvas = document.getElementById('canvas'),
			paper = new Raphael(canvas, 500, 700);
	</script>

Add the following to your stylesheet:

	#canvas svg {
		height: 500px;
		width: 700px;
		margin: 0 auto;
		margin-top: 50px;
		border: 1px black solid;
	}

We're storing the `canvas` variable for later use. Feel free to adjust the styling as you wish. That will just look like this, and won't do anything:

<div id="canvas1"></div>

As you can see, it is fairly boring. You do have the `paper` variable that Raphaël uses though, so with a little more code you can do stuff.

You can test whether it is working by adding the following to the script:

	paper.circle(350, 250, 100);

That will have created a circle in the center of the canvas with a radius of 100px. It should look like this:

<div id="canvas2"></div>


## Step two: Drawing lines

This step involves two things. The first is detecting the movement of the mouse (and whether it is down), and the second is drawing the line from that. Both are fairly easy to achieve, so I'll give you all of the code and then explain it:

	var canvas = document.getElementById('canvas'),
		paper = new Raphael(canvas, 500, 700),
		mousedown = false,
		lastX, lastY, path, pathString;
	
	$(canvas).mousedown(function (e) {
		mousedown = true;
		
		var x = e.offsetX,
			y = e.offsetY;
		
		pathString = 'M' + x + ' ' + y + 'l0 0';
		path = paper.path(pathString);
		
		lastX = x;
		lastY = y;
	});
	$(document).mouseup(function () {
		mousedown = false;
	});
	
	$(canvas).mousemove(function (e) {
		if (!mousedown) {
			return;
		}
		
		var x = e.offsetX,
			y = e.offsetY;
		
		pathString += 'l' + (x - lastX) + ' ' + (y - lastY);
		path.attr('path', pathString);
		
		lastX = x;
		lastY = y;
	});

This does a few more things than the previous code sample. First, it declares some more variable which we will be using throughout the code. Then, it adds a listener to the mousedown event on the canvas, and a listener to the mouseup event on the document. The listener on mousedown will set the initial x and y values of the mouse (because the input that Raphaël accepts wants points relative to the previous point, not relative to the top left of the canvas like with the initial point) and start off the path, creating the `path` and `pathString` variables which we will use on the mousemove event. The mousedown event will finally set two variables, `lastX` and `lastY`. the reason that we set these is so that we can work out the relative coordinates for the mousemove event.

In the mouseup event, we just set the `mousedown` variable to false. The reason that we use this variable is so that in the mousemove event handler we can tell whether the mouse is down or not - we don't want to draw the line when the mouse isn't pressed. The reason that we're adding the event listener to the document and not the canvas is that we want it to stop drawing wherever the mouse is: otherwise if we click down on the canvas, drag the mouse to another place on the document that isn't the canvas, and then let go of the mouse, it will still draw. This is a mistake that a lot of Flash games make, and it isn't one that we want to make.

In the mousemove event listener, we first check that the `mousedown` variable is set to true, and stop if it isn't. We then find out the coordinates that we want the line to go to relative to the previous point, and update the path. We then reset the `lastX` and `lastY` variables to be the new x and y values.

Your canvas should now look and behave like this:

<div id="canvas3"></div>

Magic. As you can see, it only supports 1px black lines so far, but we will be changing that in the next step…


## Step Three: Changing the width of the line

Changing the width of the line is fairly easy. Again, this step involves two things: accepting the user input, and changing the width of the line from that information we have just been given.

We're going to use the `path.attr` method to change the thickness of the line. It works like this:

	path = paper.path(pathString);
	path.attr({
		'stroke-linecap': 'round',
		'stroke-linejoin': 'round',
		'stroke-width': 7 // Width in pixels
	});

`stroke-width` sets the width of the line itself, and `stoke-linecap` and `stroke-linejoin` tells Raphaël that we want the corners and ends to be rounded (it looks odd if you don't; give it a try).

The other part of this step is to allow the user to change the width without going into the console or inspector and changing a variable. For this, we're just going to use the number keys on the keyboard. This will only allow us from 1px to 9px, but this is only a demo - if you're going to use this, you can build upon this (say, pressing any of the number keys opens a popup so that you can type your number and then press enter). We can do this using the following code:

	$(document).keydown(function (e) {
		if (e.keyCode > 48 && e.keyCode < 58) {
			width = e.keyCode - 48;
		}
	});

The `keyCode` of 1 is 49, to the `keyCode` of 9 which is 57. As they're numeric, it is safe to just take 48 from their value to get the width (although not too semantic, this should probably actually have a comment). We also have to declare the `width` variable at the top of the code with the other variables, or we will lose the value (or if you don't have strict mode enabled, it'll become global; even worse!).

Now, we have the following:

<div id="canvas4"></div>

Note that on this page, pressing the number keys will change the width for every example on the page (except for the first three, which don't support width). Either refresh the page or just press 1 to go back to the original width.


## Step three: Changing the colour of the line

Finally, we reach the last step. In this step, we add functionality to allow the user to change the colour of the line. This involves the same kind of things as before, but is a lot trickier as we're not just listening for keyboard events to accept user inputs, we're creating some coloured boxes for them to click. Whenever I write "colour" in this section, I do mean "color", of course.

Changing the colour of the line itself is fairly easy: we just need a `colour` variable at the top of the function (defaulting to "black", or whatever) and a `'stroke'` attribute on the `.attr` call we added in the previous step.

Now we just have to get the information from the user (what colour they want). To do this, we will make some coloured boxes to the left of the canvas. Replace the HTML with the following:

	<div id="canvaswrapper">
		<div id="canvascolours">
			<div data-colour="black"></div>
			<div data-colour="red"></div>
			<div data-colour="orange"></div>
			<div data-colour="yellow"></div>
			<div data-colour="green"></div>
			<div data-colour="blue"></div>
			<div data-colour="indigo"></div>
			<div data-colour="violet"></div>
			<div data-colour="white"></div>
		</div>
		<div id="canvas"></div>
	</div>

We're adding nine colours: the colours of the rainbow plus black and white. When adding or changing colours, you can use any colour string that CSS would accept (string, hex, rgb, rgba, whatever).

Replace the CSS with the following:

	#canvas svg {
		width: 700px;
		height: 500px;
		float: left;
		border: 1px black solid;
	}
	
	#canvaswrapper {
		overflow: auto;
		width: 730px;
		margin: 0 auto;
	}
	
	#canvascolours {
		width: 26px;
		float: left;
	}
	
	#canvascolours [data-colour] {
		width: 18px;
		height: 18px;
		margin-bottom: 10px;
		cursor: pointer;
		border: 1px black solid;
	}

For those of you not familiar with the syntax, `[data-colour]` selects elements with a `data-colour` attribute (`[data-colour="red"]` would refer to elements where the `data-colour` attribute is equal to "red").

I'm not setting the background colour in that CSS as I should, as `attr(data-colour)` was throwing an error in the browser I was using. We are instead using JavaScript, but that isn't a huge problem as the application won't work if it is disabled anyway. Add the following JavaScript to what is there already:

	$('#canvascolours [data-colour]').each(function () {
		var $this = $(this),
			divColour = $this.data('colour');
		
		// Change the background colour of the box
		$this.css('background-color', divColour);
		
		// Add the event listener
		$this.click(function () {
			colour = divColour;
		});
	});

That cycles through all the colour boxes we added just now, and sets the background colour and adds an event handler for the click event so that when the div is clicked, the `colour` variable is updated so that the colour of the next line is changed.

Our final application looks like this:

<div id="canvaswrapper">
	<div id="canvascolours">
		<div data-colour="black"></div>
		<div data-colour="red"></div>
		<div data-colour="orange"></div>
		<div data-colour="yellow"></div>
		<div data-colour="green"></div>
		<div data-colour="blue"></div>
		<div data-colour="indigo"></div>
		<div data-colour="violet"></div>
		<div data-colour="white"></div>
	</div>
	<div id="canvas5"></div>
</div>

## The final code

	var canvas = document.getElementById('canvas'),
		paper = new Raphael(canvas, 500, 700),
		colour = 'black',
		mousedown = false,
		width = 1,
		lastX, lastY, path, pathString;
	
	$(canvas).mousedown(function (e) {
		mousedown = true;
		
		var x = e.offsetX,
			y = e.offsetY;
		
		pathString = 'M' + x + ' ' + y + 'l0 0';
		path = paper.path(pathString);
		path.attr({
			'stroke': colour,
			'stroke-linecap': 'round',
			'stroke-linejoin': 'round',
			'stroke-width': width
		});
		
		lastX = x;
		lastY = y;
	});
	$(document).mouseup(function () {
		mousedown = false;
	});
	
	$(canvas).mousemove(function (e) {
		if (!mousedown) {
			return;
		}
		
		var x = e.offsetX,
			y = e.offsetY;
		
		pathString += 'l' + (x - lastX) + ' ' + (y - lastY);
		path.attr('path', pathString);
		
		lastX = x;
		lastY = y;
	});
	
	$(document).keydown(function (e) {
		if (e.keyCode > 48 && e.keyCode < 58) {
			width = e.keyCode - 48;
		}
	});

	$('#canvascolours [data-colour]').each(function () {
		var $this = $(this),
			divColour = $this.data('colour');
		
		// Change the background colour of the box
		$this.css('background-color', divColour);
		
		// Add the event listener
		$this.click(function () {
			colour = divColour;
		});
	});

If you use this code, I'd appreciate a link back to this to this article. If you do anything interesting with it, make sure you share it in the comments!

<script src="{{ articleimages }}/raphael-min.js"></script>
<script src="{{ articleimages }}/script.js"></script>
