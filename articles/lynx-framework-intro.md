<info>
title: An introduction to the lynx-framework
author: callumacrae
date: 1300209720
tags: lynx-framework, security, speed
summary: I'm currently writing a framework, called (suitably) the lynx-framework. Written in PHP, it is designed to be a framework for social networks. It will include plugins that are perfect for social networks, such as authentication, a news feed, profiles, messages, etc. Any part can be enabled or disabled, making it extremely easy to build any sort of social network.
</info>

I am currently writing a framework (suitably) called the lynx-framework. Written in PHP, it is designed to be a framework for social networks. It will include plugins that are perfect for social networks, such as authentication, a news feed, profiles, messages, etc. Any part can be enabled or disabled, making it extremely easy to build any sort of social network.

I've set myself a challenge that when it is done I will make a video on how to create a Twitter clone in under 15 minutes, which will demonstrate the power of the framework and also the ease of use.

The framework is based on the MVC architectural structure, meaning that stuff like styles and code are separate - this makes it easier to change large sections of HTML as you don't have to go through loads of files to change it.

It's being built with three things in mind: speed, security and usability.

We're being extremely obsessive about resource usage - we even go as far as rarely using double quotes, as they use more resources than single quotes. Not much will be loaded until you request it, and all plugins will be, again, very light in terms of resource usage. There will be an advanced caching mechanism, which will lower the amount of database queries or file includes required.

We consider security to be an extremely important element of building a website - after all, what is the point in a social network that just displays a notice saying that it has been hacked? For this reason, we are not only making sure all the code we wrote is completely secure, but also making it easier for you to write secure code. In fact, we are making it extremely difficult for you to write _insecure_ code!

Another extremely important factor we are considering while writing the framework is usability. Everything will be _easy_. No more `$db = new PDO('mysql:blablabla=bla;blabla', $username, $password');` to connect to a database - `$this->load_plugin('db');` is far easier and maintains high speeds and security. The advanced hooks system makes applying edits far easier - instead of changing core files (which could result in conflicts later on), you will be able to use the hooks system. The many plugins and helpers that will come with the lynx-framework will mean you won't have to write all the code yourself, as half of it comes, already written, with the framework.

You can find the development version of the framework [on GitHub](https://github.com/lynxphp/lynx-framework).

<p>&nbsp;</p>

Any feature requests or general suggestions would be appreciated, either email me, use the contact form, or leave a comment.

If you wish to be involved in the development of the lynx framework, start by developing a few features and sending a pull request over GitHub. Your commit will be more likely to be pulled if you use my coding standards - they're basically the [phpBB coding standards](http://area51.phpbb.com/docs/coding-guidelines.html) (parenthesises on their own lines, single quotes, etc.). If I like your work, I may contact you, inviting you to the development team. If I don't invite you, it doesn't mean I don't like your work, it may just mean I haven't noticed you yet - keep sending pull requests!