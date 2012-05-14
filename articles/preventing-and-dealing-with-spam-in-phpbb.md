<info>
title: Preventing and dealing with spam in phpBB
author: callumacrae
date: 1294466400
tags: phpBB, spam
summary: A couple days ago, the amount of spam being posted to my phpBB forum increased dramatically. I turned to the phpBB.com community forums and made my thread, and it looks like it's happening to many other people using the Q&A CAPTCHA. The Q&A CAPTCHA was added to phpBB in 3.0.6, and it allowed the board administrator to specify a question that the user had to answer on sign-up. In this article, I will explain how you can attempt to prevent them from damaging your board or hacking into your users' accounts.
</info>

A couple days ago, the amount of spam being posted to my phpBB forum increased dramatically. I turned to the phpBB.com community forums and [made my thread](http://www.phpbb.com/community/viewtopic.php?f=64&t=2116324), and it looks like it's happening to many other people using the Q&A CAPTCHA. The Q&A CAPTCHA was added to phpBB in 3.0.6, and it allowed the board administrator to specify a question that the user had to answer on sign-up. If their answer to the question matched one of a list of allowed answers the administrator had specified, the user would be permitted to sign up. If they could not provide a correct answer, they would be prohibited from signing up. This was actually extremely effective, as the questions would be things like "What is the name of this forum?" or "What colour is the sky?". A couple days back, the bots noticed that everyone was using the same questions, and so they started answering correctly, leading to a lot more spam. There have also been reports of bots attempting to hack into people's accounts on not only their own forums, but the phpBB.com forums. They weren't doing anything too advanced - they were simply trying to brute force the password using (I assume) the most common passwords people use, such as "password" or "username123". Now that I have explained what the spammers are doing, I will explain how you can attempt to prevent them from damaging your board or hacking into your users' accounts.

## Registration

The bots have been managing to register, as they are now managing to break through most of the CAPTCHAs phpBB provides. Google's reCAPTCHA was [cracked](http://www.allspammedup.com/2011/01/google-recaptcha-cracked/) a long ago, the default phpBB CAPTCHA was also cracked quite a long time ago. And now the bots have found a way to solve the Q&A CAPTCHA.

There are a few ways you can stop the bots registering / posting:

### Carry on using the Q&A CAPTCHA.

It is still the best CAPTCHA, and when used properly it will stop all spam. Make sure that you have a set of unique questions related to your target audience so that they will know the answers. Make the questions tricky enough to keep the bots out, but not so difficult that your users cannot get in. I would recommend that you have at least 10 questions, as this will make it trickier for the bots to just catalogue the questions and the acceptable answers.

An example of a good question (for lynxphp): "What is the latest version of PHP?"  
An example of a bad question: "What is the admins favourite colour?"

### Enable user activation

Enabling user activation will mean that when the user or bot registered, they will have to click on a link that is emailed to them in order to activate their account. Although a lot of bots can get round this by simply clicking on the link in their email, it seems to be having moderate success on the bots that are currently attacking. If this doesn't work, you could also enable admin activation - this means that whenever a user or bot registers an account, an email is sent to all administrators asking whether the account should be activated. The admin can then check the IP or email address against a spam database such as [Stop Forum Spam](http://www.stopforumspam.com/).

### Enable the newly registered users group

The newly registered group is a great feature. After you have activated it, users will be added to this group, and when they reach a certain post count they will be removed from it. I generally have it set to 1 or 2. You can use this group to give members who have recently registered limited access to the forums, eg their posts have to be enabled by a moderator.

To enable the newly registered group, go to ACP -> General -> User Registration Settings. When you're there, set "Set Newly Registered Users group to default" to yes and "New member post limit" to a number between 1 and 3. Then when setting individual forum permissions, set their forum permissions to "On Moderation Queue". Then you will see their posts in the MCP homepage, ready for you approve or disapprove. It is also a good idea to make sure that the newly registered users group cannot send PMs or set a signature, as these are other common techniques that spam bots use.

## Stop them from hacking into your users' accounts

Spam bots have also been attempting to brute force people's password. I experienced this on phpBB.com, but was not hacked. You can recognise that a bot has tried to brute your password by the fact that the board will force you to complete a CAPTCHA in order to sign in, as the bot has exceeded the maximum login attempts. Other signs are increased POST requests on ucp.php and increased server load.

Solving this one is easy - simply force your users to have more complex passwords. You can make them do this by going into User Registration Settings and changing "Password complexity". It is also more secure to get them to change their password every month or so, by using the "Force password change" box below the password complexity box. As long as your users don't have stupid passwords, none of your users' accounts will be hacked.

<br />

By following these steps, you will have helped prevent your board from spam. If some does get through, your users won't see it, as you will be able to delete it and ban the account.
