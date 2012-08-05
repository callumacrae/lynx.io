<info>
title: Using Socket.io with NodeJS
author: dida
date: %date%
tags: javascript, nodejs, socketio, multiplayer
summary: Node.js is a platform built on Chrome's JavaScript runtime for easily building fast, scalable network applications. Socket.IO aims to make realtime apps possible in every browser and mobile device, blurring the differences between the different transport mechanisms. It's care-free realtime 100% in JavaScript. In this tutorial, I will show you how to use them together to make real-time web applications.
</info>

*Note: To fully understand this guide, you are expected to have previous experience with JavaScript*

## Setting it up

### Installing NodeJS

To install NodeJS, visit [this official download page](http://nodejs.org/#download) and select your operating system. If you are using Linux, you will have to compile it yourself or [use a package manager](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager) .

### Installing Node Package Manager (NPM)

The latest version of Node includes NPM with it, however if you are using an older version of Node, you can still install it!

- On UNIX systems:

		curl http://npmjs.org/install.sh | sh
		
- On Windows:
		
You can download a zip file from <http://npmjs.org/dist/>, and unpack it in the same folder where node.exe lives.

### Installing Socket.io

Installing Socket.io is a nightmare:

		npm install socket.io
		
You should now have the enviroment set up required for this tutorial.

## Getting started with Socket.io

When I first started using Socket.io, the Wiki confused me very much. I could find no information on how this whole real-time communication works, so I had to figure it out myself.

*Note: In this example the variable io is socket.io required. This means: var io = require('socket.io');*

Socket.io has built-in 'exposed events' on the server side and on the client side.

**Let's talk about the client side ones first:**

When a client connets to your application:

		io.sockets.on('connection', function(client) {
			// insert client-handling code here
		}

In this case, the argument client should be used further on.

Another exposed event is to handle messages from the client.

		io.sockets.on('connection', function(client) {
			**client.on('message', function(message) {
				//insert message handling code here
			}**
		}

You might have noticed that this event was placed **into** the previous event. Why? If it was just another function itself, we would not have a client to listen to, meaning that the incoming messages would be lost.

There is one more exposed event in Socket.io:

		io.sockets.on('connection', function(client) {
			client.on('message', function(message) {
				//insert message handling code here
			})
			
			**client.on('disconnect', function() {
				//insert disconnect handling code here
			})**
		})

This one is pretty easy to understand, when the client disconnects, that function is triggered.

I lied about that one being the last exposed event. There is a function called 'emit' in Socket.io that lets you create your own events:

		io.sockets.on('connection', function(client) {
			client.on('message', function(message) {
				//insert message handling code here
			})
			
			**client.on('myevent', function(mydata) {
				//insert data handling code here
			})**
			
			client.on('disconnect', function() {
				//insert disconnect handling code here
			})
		})

You may ask: How to use these events? I gave the answer above. To trigger 'myfunction', the client side has to emit it using the emit function:

		var socket = io.connect('http://localhost');
		socket.emit('myevent', { mydata: 'data' });

This can be used on both server side and client side, meaning that you can fully customize your events.
*Note: you cannot use previously reserved event names, like connection or disconnect*

**Client side events:**

*Note: the variable socket is: var socket = io.connect('http://localhost');*

After understanding the server side exposed events, I found it easy to figure out how the client-side ones work, so I will link you to the wiki page and highlight the most important ones.

The official wiki page: <https://github.com/LearnBoost/socket.io/wiki/Exposed-events>

Connect event:

		socket.on('connect', function(){
			// call the server-side function 'adduser' and send one parameter (value of prompt)
			socket.emit('adduser', prompt("What's your desired username?"));
		});
		
I chose to use this example, because it helps you understand how to use events and functions together.
When the client connected to the server successfully, function 'adduser' is called on the server with the parameters of a propmt: the client enters his name, the data is sent to the server and is handled by the adduser function. Easy!

Connecting event:

		socket.on('connecting', ...);
		
This event is useful when you know it will take a while to connect. You can add a loading animation here.

Message event:

		socket.on('message', function(message){
			//handle message
		});
		
This event is emmited when a message sent with socket.send is received. You will use this event the most.

You probably noticed that these events are separate, unlike the ones on the server side. This is because the client doesn't have to bother about all the other clients, the server handles all the client events.

## Writing your first real-time app

Always start with setting up the server. Every time you want to create an application to be viewed with a web browser, you want to create an httpServer.

		var http = require('http');
		
That's it. You required the http module provided by Node. Still using the default Node functions, you need to create a basic web server (code always goes below each other):

		http.createServer(function (req, res) {
			res.writeHead(200, {'Content-Type': 'text/plain'});
			res.end('Hello World\n');
		}).listen(8080, '127.0.0.1');
		console.log('Server running at http://127.0.0.1:8080/');

If you have any problems with this code, please look into the HTTP module at the NodeJS documentation: <http://nodejs.org/api/>

Make sure your server is listening on port 8080 (or any other port you want), then move on to the client side and write the socket connecting part.

		<head>
			<script src="socket.io/socket.io.js"></script> <!-- require socket.io in the head part-->
		</head>
		<script>
			var socket = io.connect('http://localhost:8080');
			//connect to the server
		</script>
		
After having these done, you can move on to handling and writing your own events and coding a nice UI for the clients.

## Expanding your knowledge

After mastering the exposed events, you can find information on using rooms at the Wiki: <https://github.com/LearnBoost/socket.io/wiki/Rooms>
You can ask for help at #socket.io, irc.freenode.net
You can learn from others' source codes, make sure to check out my MouseFun game at <https://github.com/MSuhajda/MouseFun>

I really hope this tutorial helped you get started with Socket.io, I tried to cover all the problems I had when I started. Socket.io and NodeJS are extremely useful and definitely worth learning if you plan on making real-time applications.

Thanks for reading!

