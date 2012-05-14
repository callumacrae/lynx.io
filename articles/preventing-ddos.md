<info>
title: Preventing DDoS
author: callumacrae
date: 1294120800
tags: server, attack, DDoS, security
summary: Following the recent (largely successful) attacks by Anonymous Operation on more than a few websites including Paypal, Mastercard and Visa, a few people asked me if they were at risk of being attacked and how they could prevent it. In this article, I will explain various ways of stopping DDoS, and whether they actually work or not.
</info>

Following the recent successful attacks by Anonymous Operation on websites including Paypal, Mastercard and Visa, a few people asked me if they were at risk of being attacked and how they could prevent it.

If you hadn't heard about the attacks, PandaLabs have a very good article about it [here](http://pandalabs.pandasecurity.com/tis-the-season-of-ddos-wikileaks-editio/).

## What is DDoS?

A Distributed Denial of Service attack is a method of attacking a server so that genuine users cannot access it. Usually, the attacker has what is known as a "botnet" - several thousand computers that have been infected with malware without their users consent. The attacker then gets his botnet to send thousands of requests to one server, which either slows it down drastically or takes it completely offline.

Another common method of attack, known as distributed reflected denial of service attack (DRDoS), involves spoofing the IP of the server that is going to be attacked, and then sending requests of some type to many servers. They will reply to the IP that was spoofed, in this case the server that's being attacked. It will seem to the victim's server that the entire internet is attacking them, but it will not have much of an effect on the servers that are having the requests sent to them by the attacker.

The method of attack used by Anonymous to attack their victims is very similar to the first method I explained - a botnet of computers sent millions of requests, slowing down the server dramatically. The only difference was that the "botnet" had not been affected with malware. It was a "voluntary botnet"; thousands of people around the world installed software called LOIC - Low Orbit Ion Cannon - on their computers, which then connected to the Anonymous Operation Internet Relay Chat (IRC) server and sat in a channel waiting for commands. It then required an operator to tell the LOIC software who to attack, then the software would attack. This makes it very easy for the user, as it meant all they had to do was install the software and let it run in the background.

Okay, it is slightly more complicated than that, but you get the picture.

Knowledgeably participating in a DDoS attack is illegal in most countries, and I would strongly advise against you attacking anyone.


## How can I protect myself against DDoS?

Realistically, it's not really possible to protect yourself for sure from a DDoS attack, but there a few things you can try to make the attack less effective. First, I will explain how the server works (it'll be complicated):

There are 7 layers to the OSI model (Open Systems Interconnect) for networking.

Layer 1 (Physical) - Network card, cable
Layer 2 (Data Link) - ARP (tells what IP address has which MAC address), PPP, etc.
Layer 3 (Network) - IPv4, IPv6, ICMP (ping, traceroute)
Layer 4 (Transport) - TCP, UDP
Layer 5 (Session) - SSH
Layer 6 (Presentation) - X.25, AFP, ASCII
Layer 7 (Application) - HTTP, SMTP

When a connection is made, the requesting program tells the OS to open a socket, the data is sent to the network card, to the cable, to the switch/hub, to the router, to the ISP, to routers, to the receiving router, to the switch/hub, to the cable, to the network card, to the OS.

To speak to the server, a TCP connection (layer 4) is made.

### Block port 80

To speak to the server, a TCP connection (layer 4) is made. HTTP is on layer 7. This means that trying to stop an attack on layer 7 will not help. A connection has already been made and they are already using bandwidth.

Of course, this is all assuming the attackers are even attacking HTTP. Sure, if you're limited to a certain amount of bandwidth, blocking port 80 will certainly help reduce the amount of bandwidth sent out, meaning it's less likely that you will be suspended by your host or ISP. It will not, however, help the server load, and you will be blocking genuine users.

### Block the attackers' IPs

A few people I spoke to said they checked the IP of the machine sending the request against their access logs. If more than a certain amount of requests were sent within a short space of time from the same IP, that IP would be blocked. This method would be effective against small attacks, but useless against larger attacks. Also, IP addresses can be spoofed, meaning that the attackers can easily get round the ban.

Again, they were still dealing with the problem at layer 7. The webserver has to check each connection to see if it matches the disallow in .htaccess, driving up load, and not helping prevent the attack at all.

Some software exists that adds the IPs directly to the firewall. The firewall is yet another layer 7 application. It doesn't mean the software is completely useless, but it still won't solve the problem completely.

### Serve an empty page while you're being attacked

Same problem as before. It will save bandwidth, but it will still anger the server and block genuine users.

### Get better hardware

If you get better hardware, your server will be able to deal with more connections and more requests. This means that during smaller attacks, your website would load faster than on the old hardware, but larger attacks will still cripple the server - the biggest of attacks could take out entire datacenters.

### Get your ISP to filter the traffic

Some ISPs will have DDoS protection already. It varies a lot depending on the ISP - some will just look at layers 3 and 4, while others will also look into layer 7, examining the contents of the HTTP sessions (for example). I don't know much about this, you would be best off contacting your ISP. If you discover anything useful, please let me know so I can include it in the article :)

### Don't annoy the hackers

Not getting DDoSed in the first place seems like the best option. But life doesn't really work like that, and hackers don't always work like that. Just don't insult their mothers.

<p>&nbsp;</p>

Realistically, there is no efficient way of stopping a DDoS attack. The best way of preventing attacks is to get your ISP to filter the traffic, but even that might not work sometimes. If you know who is attacking, report them to the authorities (or write to their mothers).
