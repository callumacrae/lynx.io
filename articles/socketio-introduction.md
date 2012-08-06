<info>
title: Using Socket.io with NodeJS
author: dida
date: %date%
tags: javascript, nodejs, socketio, real time
summary: Node.js is a platform built on Chrome's JavaScript runtime for easily building fast, scalable network applications. Socket.IO aims to make realtime apps possible in every browser and mobile device, blurring the differences between the different transport mechanisms. It's care-free realtime 100% in JavaScript. In this tutorial, I will show you how to use them together to make real-time web applications.
</info>

*Note: To fully understand this guide, you are expected to have previous experience with JavaScript and NodeJS*

## Setting it up

### Installing NodeJS

NodeJS is a platform built on Chrome's Javascript runtime. It is event-driven, lightweight and efficient, perfect for data-intensive real-time applications. NodeJS does not require a web server, it can function as a web server itself.

To install NodeJS, visit [the official download page](http://nodejs.org/#download) and select your operating system. If you are using Linux, you will have to compile it yourself or [use a package manager](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager).

### Installing Node Package Manager (NPM)

NPM is a Package Manager for Node, like Aptitude for Linux or like Gem for Ruby. Using it makes installing and maintaining packages easier and it also manages dependencies for an application.

The latest version of Node includes NPM with it, however if you are using an older version of Node, you can still install it.

- On UNIX-like systems:

		curl http://npmjs.org/install.sh | sh
		
- On Windows:
		
You can download a zip file from <http://npmjs.org/dist/>, and unpack it in the same folder where node.exe lives.

### Installing Socket.io

Installing Socket.io is also a piece of cake:

		npm install socket.io
		
You should now have the enviroment set up required for this tutorial.

## Getting started with Socket.io

When I first started using Socket.io, the Wiki confused me a lot. I couldn't find any information on how this whole real-time communication works, so I had to figure it out myself.

We will start learning by having a look at Socket.io's built-in exposed-events. These are events, just like in any other programming language, although you can't overwrite any of them or use their reserved names.

These exposed events differ are different on the server and the client side.

Every event consists of two parts: a *when to do it* and *what to do*

*Note: In this example the variable `io` is socket.io required. This means: `var io = require('socket.io');`*

**Let's talk about the server side ones first:**

When a client connects to your application (server-side code):

		io.sockets.on('connection', function(client) {
			//insert client-handling code here
		});

We'll be using the `client` argument further on in this chapter.

Another exposed event is for handling messages from the client:

		io.sockets.on('connection', function(client) {
			client.on('message', function(message) {
				//insert message handling code here
			});
		});

You might have noticed that this event was placed **into** the previous event. Why? If it was just another function itself, we would not have a client to listen to, meaning that the incoming messages would be lost.

There is one more exposed event:

		io.sockets.on('connection', function(client) {
			client.on('message', function(message) {
				//insert message handling code here
			});
			
			client.on('disconnect', function() {
				//insert disconnect handling code here
			});
		});

This one is pretty easy to understand, when the client disconnects, that function is triggered.

I lied about that one being the last exposed event. There is a function called 'emit' in Socket.io that lets you create your own events:

		io.sockets.on('connection', function(client) {
			client.on('message', function(message) {
				//insert message handling code here
			});
			
			client.on('myevent', function(mydata) {
				//insert data handling code here
			});
			
			client.on('disconnect', function() {
				//insert disconnect handling code here
			});
		});

To trigger 'myfunction', the client side has to emit it using the emit function:

		var socket = io.connect('http://localhost');
		socket.emit('myevent', { mydata: 'data' });

This can be used on both server side and client side, meaning that you can fully customize your events.

*Note: you cannot use previously reserved event names, like connection or disconnect*

**Client side events:**

*Note: the variable socket is: `var socket = io.connect('http://localhost');`*

After understanding the server side exposed events, I found it easy to figure out how the client-side ones work, so I will link you to the wiki page and highlight the most important ones.

The official wiki page: <https://github.com/LearnBoost/socket.io/wiki/Exposed-events>

Connect event:

		socket.on('connect', function(){
			// call the server-side function 'adduser' and send one parameter (value of prompt)
			socket.emit('adduser', prompt("What's your desired username?"));
		});
		
I chose to use this example, because it helps you understand how to use events and functions together.

When the client connected to the server successfully, function `adduser` is called on the server with the parameters of a propmt: the client enters his name, the data is sent to the server and is handled by the `adduser` function. Easy!

Connecting event:

		socket.on('connecting', ...);
		
This event is useful when you know it will take a while to connect. You could add a loading animation here.

Message event:

		socket.on('message', function(message){
			//handle message
		});
		
This event is emitted when a message sent with `socket.send` is received. You will use this event the most.

You probably noticed that these events are separate, unlike the ones on the server side. The reason for this is that the client only has to communicate with the server, but not the other clients.

## Writing your first real-time app

Always start with setting up the server. Every time you want to create an application to be viewed with a web browser, you want to create an `httpServer`.

		var http = require('http');
		
That's it. You required the http module provided by Node. Still using the default Node functions, you need to create a basic web server (code always goes below each other):

		http.createServer(function (req, res) {
			res.writeHead(200, {'Content-Type': 'text/plain'});
			res.end('Hello World\n');
		}).listen(8080, '127.0.0.1');
		console.log('Server running at http://127.0.0.1:8080/');

If you have any problems with this code, please look into the HTTP module at the NodeJS documentation: <http://nodejs.org/api/>

**Using the Express framework**

<http://expressjs.com/>

Express is a minimal and flexible Node.js web application framework, providing a robust set of features for building single and multi-page, and hybrid web applications. It makes routing, handling requests and sessions easier. 

Here's how creating a simple HTTP server looks like:

		var express = require('express');
		var app = express();

We first required the framework, then created a new application with the express() function.
We can now start routing:

		app.get('/', function(req, res){
 			res.send('Hello World');
		});

In this example "GET /" responding with the "Hello World" string. The `req` and `res` are the exact same objects that node provides to you, thus you may invoke `res.pipe()`, `req.on('data', callback)` and anything else you would do without Express involved.

Now, we have to initialize our server:

		app.listen(8080);
		console.log('Listening on port 8080');

One more great thing about this framework is that it can work together with SocketIO. There are examples on this on the official page of [Socket.io](http://socket.io)


Let's get back to coding:

Make sure your server is listening on port 8080 (or any other port you want), then move on to the client side and write the socket connecting part.

		<script src="socket.io/socket.io.js"></script> <!-- require socket.io in the head part-->
		<script>
			var socket = io.connect('http://localhost:8080');
		</script>
		
After having these done, you can move on to handling and writing your own events and coding a nice UI for the clients.

## More on custom events

The emit function can be used for calling custom events, as we discussed above. I will now show you an examples, where more custom events are called after each other.

Let's set up the server side:

		var app = require('http').createServer(handler)
  		, io = require('socket.io').listen(app)
  		, fs = require('fs')

		app.listen(8080);

		function handler (req, res) {
			fs.readFile(__dirname + '/index.html',
			function (err, data) {
				if (err) {
					res.writeHead(500);
					return res.end('Error loading index.html');
				}
				res.writeHead(200);
				res.end(data);
				});
			}
			io.sockets.on('connection', function (socket) {
				socket.emit('news', { hello: 'world' });
				socket.on('my other event', function (data) {
				console.log(data);
			});
		});

When a client connects, the 'news' event is emitted and 'world' is sent. When the client emits 'my other event', the data received is logged to the console.

On the client side:

		<script src="/socket.io/socket.io.js"></script>
		<script>
			var socket = io.connect('http://localhost:8080');
			socket.on('news', function (data) {
				console.log(data);
				socket.emit('my other event', { my: 'data' });
			});
		</script>

When the 'news' function is emitted by the server, the data is logged to the console and 'my other event' is emitted.

I hope this will give you an idea on how to use it when developing websites or applications.

## Storing data associated to a client

It may sometimes be necessary to store data associated with a client. This type of data is kept until the client disconnects.

Remember the example we did above? Your exercise after this part will be to rewrite it using `socket.set`. Let's see an example to make it easier:

Server side:

		var io = require('socket.io').listen(8080);

		io.sockets.on('connection', function (socket) {
  			socket.on('adduser', function (name) {
    				socket.set('nickname', name, function () { socket.emit('ready'); });
  			});

  			socket.on('msg', function () {
    				socket.get('nickname', function (err, name) {
      					console.log('Chat message by ', name);
    				});
  			});
		});

When `adduser` is emitted on the client side, the data (name) is set to 'nickname' and after this is done, event 'ready' is emitted on the server side.

Retreiving the data from a client can be done with `socket.get`. The usage is:

		socket.get('data', function(err, data) {}

On the client side:

		<script>
 		 var socket = io.connect('http://localhost:8080');

 		 socket.on('connect', function () {
  		  	socket.emit('set nickname', prompt('What is your nickname?'));
  		  	socket.on('ready', function () {
  		    		console.log('Connected!');
   		   		socket.emit('msg', prompt('What is your message?'));
   		 	});
 		 });
		</script>

One thing to note in this example is that the message sent from the client is not used.

## Putting it together

Let's make a full application together: we want it to have a counter that shows the number of connected client and we also want every client to be able to choose a username. 

server.js:

		var http = require('http')
  		, url = require('url')
  		, fs = require('fs')
  		, io = require('socket.io')
  		, server;
		
		server = http.createServer(function(req, res){
			var path = url.parse(req.url).pathname;
			
			switch (path){
				case '/index.html':
					fs.readFile(__dirname + path, function(err, data){
						if (err) return send404(res);
						res.writeHead(200, {'Content-Type' : 'text/html'})
						res.write(data, 'utf8');
						res.end();
					});
				break;
				default: send404(res);
			}
		}),
		
		send404 = function(res){
			res.writeHead(404);
			res.write('404');
			res.end();
		};

		server.listen(8080);

		var io = io.listen(server)
		
		var numberOfPlayers = 0;
		
		io.sockets.on('connection', function(client){
			players.push(client.id);

			client.on('adduser', function(username){

				socket.set('nick', username, function() {
					socket.get('nick', function(err, nick) {
						io.sockets.json.send({ connectVar: nick, client.id] });
					}
				});

				numberOfPlayers = numberOfPlayers+1;

				io.sockets.json.send({ numberOfPlayers: numberOfPlayers});

			});

			client.on('disconnect', function(){
	
				socket.get('nick', function (err, nick) {
					io.sockets.json.send({ disconnectVar: nick, client.id] });
				}

				numberOfPlayers = numberOfPlayers-1;

				io.sockets.json.send({ numberOfPlayers: numberOfPlayers});
				//send all the clients the updated number of players
			});
		});

And now index.html:

		<!doctype html>
		<html>
 			<head>
			<meta charset="utf-8">
    			<title>Lynx.io - Socket.io tutorial</title>
 			</head>
  			<body>
    			<script src="/socket.io/socket.io.js"></script>
			<script>
				function handle(data){
					if (data.connectVar) {
						var userid = data.connectVar[1];
						var username = data.connectVar[0];
						var connectionDiv = document.getElementById('connectionDiv');
						connectionDiv.innerHTML = username + ' connected';
						connectionDiv.style.display = 'block';
					}
					else if (data.disconnectVar) {
						var userid = data.disconnectVar[1];
						var username = data.disconnectVar[0];
						var connectionDiv = document.getElementById('connectionDiv');
						connectionDiv.innerHTML = username + ' disconnected';
						connectionDiv.style.display = 'block';
					}
					else if (data.numberOfPlayers) {
						var numberOfPlayers = data.numberOfPlayers;
						var numberDiv = document.getElementById('connectedPlayers');
						numberDiv.innerHTML = 'Connected players: ' + numberOfPlayers;
					}
				}

				var socket = io.connect('http://localhost:8080');

				socket.on('connect', function(){
					socket.emit('adduser', prompt("What's your desired username?"));
				});
				
				socket.on('message', function(data){
					handle(data);
				});
			</script>
			<div id='connectedPlayers'>Connected players: 1</div>
			<div id='connectionDiv' style='display:none'></div>
			</body>
		</html>

It isn't that hard after you get used to how SocketIO works. I know that you can learn much faster by reading source code, so make sure to read through the above code several times, until you know how every part works!

There is an important thing about Socket.io that I am going to highlight. There is a huge difference between `socket.send` and `io.sockets.send`: `socket.send` sends data from the client to the server or from the server to one **single** client, while `io.sockets.send` broadcasts data to all of the connected clients.

## Expanding your knowledge

After mastering the exposed events, you can find information on using rooms at the Wiki: <https://github.com/LearnBoost/socket.io/wiki/Rooms>

You can ask for help on the #socket.io IRC channel; #socket.io on [Freenode](irc://irc.freenode.net).

You can learn from others' source codes, make sure to check out my MouseFun game at <https://github.com/MSuhajda/MouseFun>

I hope this tutorial helped you get started with Socket.io, I tried to cover all the problems I had when I started. Socket.io and NodeJS are extremely useful and definitely worth learning if you plan on making real-time applications.

Thanks for reading!

