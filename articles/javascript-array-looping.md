<info>
title: Array Looping in JavaScript
author: callumacrae
date: %date%
tags: javascript, arrays, looping
summary: In JavaScript 1.6, two new array methods were introduced for looping through arrays. They are the `.map` and `.forEach` functions, and this article will explain what they do and how they work. As they were only added fairly recently, certain browsers - such as Internet Explorer 8 and earlier - don't support this feature. For this reason, I'll also be discussing how you can add the function or work around them.
</info>

In JavaScript 1.6, two new array methods were introduced for looping through arrays. They are the `.map` and `.forEach` functions, and this article will explain what they do and how they work.

As they were only added fairly recently, certain browsers - such as Internet Explorer 8 and earlier - don't support this feature. For this reason, I'll also be discussing how you can add the function or work around them.


## Array.forEach

The `.forEach` method of an array is fairly similar to foreach loops in other languages, but with a slighty different syntax. Take the following code:

	var numbers = ['one', 'two', 'three'], number;
	for (var i = 0; i < numbers.length; i++) {
		number = numbers[i];

		// Do stuff here
	}

Using the `.forEach` method, you can write it like this:

	var numbers = ['one', 'two', 'three'];
	numbers.forEach(function (number, i) {
		// Do stuff here
	});

It looks nicer, and executes the code in a new scope due to the anonymous function (which may or may not be an advantage; for me, it is usually an advantage).

This method also accepts a second argument which allows you to specify the scope that the function should be called with:

	var numbers = ['one', 'two', 'three'];
	numbers.forEach(function (number, i) {
		console.log(this === numbers); // true
	}, numbers);

I'm not entirely sure what the point in this argument is, as it can be achieved using `Function.bind`:

	var numbers = ['one', 'two', 'three'];
	numbers.forEach((function (number, i) {
		console.log(this === numbers); // true
	}).bind(numbers));

They both have the same effect, but the second is slightly more clear.


### Polyfilling Array.forEach

jQuery has a function which can be used instead of `.forEach`, and works in browsers that don't support `.forEach` natively. It is fairly self-documenting; the only thing to note is that the index and the value itself are the other way round to with `.forEach` itself.

	var numbers = ['one', 'two', 'three'];
	$.each(numbers, function (i, number) {
		// Do stuff here
	});

You can also add it yourself using the following code:

	if (!Array.prototype.forEach) {
		Array.prototype.forEach = function (cb, scope) {
			for (var i = 0; i < this.length; i++) {
				cb.call(scope, this[i], i, this);
			}
		};
	}

It doesn't matter if `scope` is undefined, as `.call` will replace it with the default value (in this case, the `window` variable).


## Array.map

The `.map` method of an array is similar to `.forEach`, but more fun; it returns an array of returned values:

	var numbers = [1, 2, 4];
	var newNumbers = numbers.map(function (number, i) {
		return number * 2;
	});
	
	console.log(newNumbers); // [2, 4, 8]

That can be pretty useful! The original array is left intact.

Again, the `.map` method accepts a second parameter to specify the scope.


### Polyfilling Array.map

jQuery also has a function for this, `.map`. Again, it is self-documenting:

	var numbers = [1, 2, 4];
	var newNumbers = $.map(numbers, function (number, i) {
		return number * 2;
	});

	console.log(newNumbers); // [2, 4, 8]

You can also add it yourself using the following code:

	if (!Array.prototype.map) {
		Array.prototype.map = function (cb, scope) {
			var i, returnArray = [];

			for (i = 0; i < this.length; i++) {
				returnArray.push(cb.call(scope, this[i], i, this));
			}

			return returnArray;
		};
	}
