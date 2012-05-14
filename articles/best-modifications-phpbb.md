<info>
title: The five best modifications for phpBB
author: callumacrae
date: 1294380000
tags: phpbb, modifications
summary: Modifications are a way of customising your phpBB board. They can do anything, from adding a new feature, to changing an already existing feature, to completely removing a feature! "Modifications" is often shortened to "MODs". In this article I will be explaining what I think the best modifications for phpBB are and why.
</info>

Modifications are a way of customising your phpBB board. They can do anything, from adding a new feature, to changing an already existing feature, to completely removing a feature! "Modifications" is often shortened to "MODs". In this article I will be explaining what I think the best modifications for phpBB are and why.

You can find the phpBB Modification Database here: <http://www.phpbb.com/customise/db/modifications-1/>

<br>

So, the five best MODs (in my opinion):

## AutoMOD

AutoMOD is a tool to automatically install/uninstall MODs in phpBB. It is the first MOD I install on any board, and I install it on every board I use. It has saved me a lot of time in the past, as with AutoMOD I just have to click "install", while the code edits could potentially have taken hours.

AutoMOD will be replaced in phpBB 3.1 by a built in modification installer.

[Download link](http://phpbb.com/mods/automod/)


## Ultimate Points Mod

The Ultimate Points Mod is a cash mod for phpBB which introduces a forum "currency" - when users make posts and threads, they are given "points", which they can then send to other users, gamble in the lottery, or spend it in several mods that are compatible with the ultimate points mod, such as the arcade mod or shop mod.

Okay, it's a bit of a niche market, but it's one of the best MODs I have used. It has an easy install and configuration process, and it's also easy to use.

[Download link](http://www.phpbb.com/customise/db/mod/ultimate_points/)


## phpBB3 Portal

This modification is an essential for many boards. You can see it on their website, <http://www.phpbb3portal.com/>. As you can see, it adds some content to the index page, instead of a list of forums. This not only makes your home page more interesting, but it allows you to tell your users stuff about your board on the very first page they see.

Only one problem. Let's throw that page through a validator - 44 errors, 3 warnings. As you can see, they're using invalid HTML, and they've also randomly got css in the middle of the &lt;body>, which not only slows down the page loading time, but is really ugly. The MOD author should have put the css in an external file and used &lt;!-- if IN\_PORTAL --> to check whether the user is in the portal.

[Download link](http://www.phpbb3portal.com/)


## Advertisement Management

This highly flexible advertisement manager is just amazing - it allows you to specify the code for your ads, how long you want the ads to stay up for (using both time and clicks/impressions) and tracks how many impressions or clicks the ad has got. It makes it easy to add ads, and lets you put them in a variety of positions. I found it very easy to install and configure (but perhaps not the greatest if you're no good at styling)

[Download link](http://www.phpbb.com/customise/db/mod/advertisement_management/)


## Activity Stats MOD

The Activity Stats MOD lists all registered users who have visited the board in the last 24 hours and lists stats on the number of new posts, new topics and new users within the last 24 hours on the index. It's kinda similar to the stats that are already there, but it says what's just happened in the last 24 hours. Nothing else needs saying - install it and take a look for yourself.

[Download link](http://www.phpbb.com/customise/db/mod/activity_stats_mod/)


## Others

There are a couple modifications that are also worth a mention, but are too niche market or not quite good enough to make the list:

* [phpBB Arcade](http://www.phpbb.com/community/viewtopic.php?t=685225)
* [AJAX Chat MOD](http://startrekguide.com/community/viewtopic.php?f=127&t=8675)
* [QuickInstall](http://www.phpbb.com/mods/quickinstall/)
