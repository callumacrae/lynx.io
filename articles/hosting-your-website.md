<info>
title: Hosting your website
author: callumacrae
date: 1296674040
tags: hosting, free hosting, server, shared, vps
summary: There are many ways your can host your website, and some of them may seem quite complicated. In this article, I aim to clear up the various methods and help you decide which method is best for you. I will also give you some basic tips on finding a good host.
</info>

There are many ways your can host your website, and some of them may seem quite complicated. In this article, I aim to clear up the various methods and help you decide which method is best for you. I will also give you some basic tips on finding a good host. I am aiming to keep this article as unbaised as possible, so I won't recommend any specific hosts.

The easiest way of hosting your website only applies (mainly) to forums and blogs. There are dedicated forum / blog hosts out there. The hosting will be extremely easy to set up, and will usually just be a case of filling out a few boxes with a username and email, etc. However, you are completely at the mercy of your host - some may put ads on your site, some may not. Most will not give you file access, meaning that you cannot take backups or install modifications and custom styles. They decide what styles you get. If they go bust, you have lost your website as you generally cannot take backups with hosts like this.

Pros:

* Very easy to use

Cons:

* You don't have much control
* You can't take backups

<p>&nbsp;</p>

Another type of hosting is shared hosting. Most free hosting is shared hosting, as it is very easy for the administrator of the hosting company to set up. Shared hosting means that you share a server with other clients of the company - the number of people you could be sharing with could range from several people to several thousand people. Unfortunately, this means that the server can be quite slow, and if anyone gets attacked, everyone's website goes down. This is generally unlikely though, as hosts have mechanisms in place to prevent this from happening. To use shared hosting, you don't have to possess much knowledge of server administration, as most of it is done for you by the administrator.

Pros:

* Reasonably easy to use
* Gives you quite a lot of control
* Quite secure

Cons:

* You're sharing it, so if one person gets attacked, everything goes down
* Still not as much control as a VPS or dedicated server

<p>&nbsp;</p>

The type of hosting I prefer, and the type lynxphp is hosted on, is a VPS. VPS stands for Virtual Private Server, and is a exactly what is sounds like - a server running in a virtual machine that you have all to yourself. The advantage of having it to yourself is that you have complete control over everything; you can access using it whatever means you like (SSH, FTP, etc.), and you can run whatever you like on it (Apache, nginx, lighttpd, etc.). Not only does this mean that you can optimise it specifically for your website, it also means that the level of security can be higher. It requires a good knowledge of (usually) Unix / Linux systems administration, as most VPSs come "unmanaged" - the host doesn't do anything at all. Also, they tend to be faster.

Pros:

* Full control
* Can be extremely secure
* Usually faster then shared hosting

Cons:

* Tricky to use if you don't know how
* Unmanaged
* Expensive compared to shared hosting

<p>&nbsp;</p>

The final type of hosting I will cover is "dedicated" hosting. This is basically exactly the same as VPS, but it isn't virtual - you get an entire server to yourself. While extremely expensive in comparison to shared and VPS hosting, they tend to be far faster and allow even more control. I have never used a dedicated server, so I don't know much about them, but I know that you do not want to get a dedicated server unless you know exactly what you're doing and have experience with Unix / Linux. The other advantage over VPS that a dedicated server can offer besides the speed and better spec is that your VPS server can slow down in cases of extreme resource usage on the host server, such as DDoS attacks (even on other accounts on the same server).

Pros:

* Full control
* Can be extremely secure
* VERY fast
* Extremely reliable

Cons:

* Tricky to use if you don't know how
* Unmanaged
* Usually very expensive

<p>&nbsp;</p>

When choosing hosting, make sure you research the host thoroughly. Ignore all reviews for hosts that say "Rubbish host, I was suspended for nothing - I was only hosting my nulled vBulletin website!" - these reviews are good and mean that the host get rid of Terms of Service breakers. This (hopefully) also includes the people who are using above their fair share of CPU, so the server won't be bloated because of them. Especially with free hosting, you might just be best of signing up for a month of two to test, as you can easily move out again. When buying dedicated servers, contact the host directly before purchasing if you have any questions. If they don't answer, don't buy from them.