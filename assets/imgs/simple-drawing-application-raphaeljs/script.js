window.onload = function () {
	(function () {
		var canvas = document.getElementById('canvas1'),
			paper = new Raphael(canvas, 500, 700);
	})();
	(function () {
		var canvas = document.getElementById('canvas2'),
			paper = new Raphael(canvas, 500, 700);
	
		paper.circle(350, 250, 100);
	})();
	(function () {
		var canvas = document.getElementById('canvas3'),
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
	})();
	(function () {
		var canvas = document.getElementById('canvas4'),
			paper = new Raphael(canvas, 500, 700),
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
	})();
	(function () {
		var canvas = document.getElementById('canvas5'),
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
	})();
};