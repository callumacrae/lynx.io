<info>
title: Currying in JavaScript
author: callumacrae
date: 1343233415
tags: currying, functions, javascript
summary: Currying is a technique for transforming a function which accepts multiple parameters into multiple functions that accept a lower number of arguments. In this article, I will explain how you can curry functions in JavaScript, and I will also explain how to curry by length and uncurry functions.
</info>

Currying is a technique for transforming a function which accepts multiple parameters into multiple functions that accept a lower number of arguments. In this article, I will explain how you can curry functions in JavaScript, and I will also explain how to curry by length and uncurry functions.

The previous explanation of currying wasn't very easy to understand, so I'll explain it with an example:

Say we have a function which takes a two numbers and multiples them together:

	function multiply(a, b) {
		return a * b;
	}

Then we can create the curried function, which when called will return a new function:

	function curriedMultiply(a) {
		return function (b) {
			return multiply(a, b);
		}
	}

That function allows us to do stuff like this:

	var multBy2 = curriedMultiply(2);
	var multBy3 = curriedMultiply(3);
	multBy2(4); // 8
	multBy3(1.5); // 4.5

	curriedMultiply(6)(7); // 42

That's a very simple example. Let's take the same principle, but with a function that accepts any number of arguments:

	function multiply() {
		var final = 1;

		for (var i = 0; i < arguments.length; i++) {
			final *= arguments[i];
		}

		return final;
	}

The curried function:

	function curriedMultiply() {
		var a = Array.prototype.slice.call(arguments); // Convert to array

		return function () {
			var b = a.concat(Array.prototype.slice.call(arguments));

			return multiple.apply(null, b);
		}
	}

We can use it like this:

	var multBy8 = curriedMultiply(2, 4);
	multBy8(2, 3); // 48

	curriedMultiply(1, 2, 3)(4, 5, 6); // 720

You can see how something like this would be useful.

## Generic currying function

Instead of writing all that out every time, it can be useful to have a generic function to do the currying for us. A lot of libraries have something like this built in:

	function curry(func) {
		var a = Array.prototype.slice.call(arguments, 1);

		return function () {
			var b = a.concat(Array.prototype.slice.call(arguments));

			return func.apply(null, b);
		}
	}

We can then use that like this:

	var multBy8 = curry(multiple, 2, 4);
	multBy8(5); // 40

## Curry by length

It may also sometimes by useful to curry by length. For example, we might want to do something like this:

	curryN(multiply, 3)(1, 2)(3, 4)(5, 6); // 720
	curryN(multiply, 2)(2)(3, 4); // 24

We can do that using the following function:

	function curryN(func, n) {
		var args = [];

		var curry = function () {
			args = args.concat(Array.prototype.slice.call(arguments));
			return (--n) ? curry : func.apply(null, args);
		};

		return curry;
	}

The slightly ugly ternary in the middle is responsible for ending the loop: if it has been called 3 times and `n` was 3, `n` will now be equal to zero, and so will evaluate as falsy, meaning that the function will be called. Anything more than that, and it will return the `curry` function (not to be confused with the function with that name we had before).

## Uncurrying

Uncurrying is the opposite to currying - it takes multiple short functions and allows them to be called in one function. Say we have the following functions:

	function multBy2(a) {
		return a * 2;
	}
	function add3(a) {
		return a + 3;
	}

We want to make a `multBy2andAdd3` function (I know; it's just an example name!) from these. Simple - we can just call one after the other:

	function multBy2andAdd3(a) {
		return add3(multBy2(a));
	}

It works:

	multBy2andAdd3(3); // 9
	multBy2andAdd3(0); // 3

The generic function for uncurrying is slightly more complicated than the generic function for currying, but it is still fairly easy to understand:

	function uncurry() {
		var funcs = Array.prototype.slice.call(arguments);

		return function (a) {
			var i = funcs.length;
			while (i--) {
				a = funcs[i](a);
			}
			return a;
		}
	}

We can then call it like this:

	var multBy2andAdd3 = uncurry(add3, multBy2);
	multBy2andAdd3(3); // 9
	multBy2andAdd3(0); // 3

The reason we loop through the arguments backwards is so that we don't have to rearrange the arguments; if we looped through it forwards, it would produce the following:

	var multBy2andAdd3 = uncurry(add3, multBy2);
	multBy2andAdd3(3); // 12
	multBy2andAdd3(0); // 6

Those, obviously, are not the correct results!

<p>&nbsp;</p>

In summary, currying can be very useful for making your code shorter, DRYer, and more readable. It also makes writing the code a lot easier, often.