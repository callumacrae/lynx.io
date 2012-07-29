<info>
title: Introduction to phpBB
author: dida
date: %date%
tags: phpbb, introduction, themes, style, installation, administration
summary: In this guide, I will introduce the reader into the core features of phpBB and guide him through the installation.
</info>
##Contents:
- <a href="#1">Introduction to phpBB</a>
	- <a href="#1-1">Quotations</a>
	- <a href="#1-2">History and future</a>
		- <a href="#1-2-1">History</a>
		- <a href="#1-2-2">Future</a>
- <a href="#2">Features</a>
- <a href="#3">Installation</a>
- <a href="#4">Usage</a>
	- <a href="#4-1">Administration</a>
	- <a href="#4-2">Installing styles</a>
	- <a href="#4-3">Customizing styles</a>
	- <a href="#4-4">Mods</a>
- <a href="#5">Conclusion</a>
<br />

##Introduction to phpBB
__________
<br />

###Quotations

- phpBB.com: 
>*phpBB is a free flat-forum bulletin board software solution that can be used to stay in touch with a group of people or can power your entire website. With an extensive database of user-created modifications and styles database containing hundreds of style and image packages to customise your board, you can create a very unique forum in minutes.*

- Wikipedia.com: 
>*phpBB is a popular Internet forum package written in the PHP scripting language. The name "phpBB" is an abbreviation of PHP Bulletin Board. Available under the GNU General Public License, phpBB is free and open source software.*

<br />

###History and future

<br />

####History

>phpBB was started on June 17, 2000 by James Atkinson who was planning to to make a simple UBB (ultimate bulletin board)-like for for his own website. Later, two other developers joined the team and the work on 1.0.0 began.
phpBB 1.0.0 was released on December 16, 2000. During the development of this version, several more developers joined the project and the forum has gone through a huge improvement.
<br />
<center><img src="http://f.cl.ly/items/452n3O1o2u2a2i3B002w/Image%202012.07.26%2018:01:29.png" alt="phpBB 1.0" title="" /><br />phpBB 1.0</center> <br />
<br />
In February 2001, the development of phpBB started again from scratch and was released on April 4, 2001 (originally the developers planned to release it on April 1).
The improvements continued and in January 2005 lead developer Paul Owen announced that due to the lack of backward compatibility with phpBB 2.0.x the new version would be named phpBB3. Following seven months in the release candidate stage, phpBB 3.0.0 was officially released on December 13, 2007.
<br />
Source: <a href="phpbb.com">http://www.phpbb.com/about/history/</a> & <a href="wikipedia.com">Wikipedia</a>
<br />

####Future

>The future is bright for phpBB with an open, community-focused method of development. In addition to the continued development of phpBB 3.0 “Olympus” and phpBB 3.1 “Ascraeus”, planning has also begun for future releases 3.2 “Arsia” and 4.0 “Rhea”.
<br />

##Features
__________
<br />
***A list of all the features can be found on the official phpBB website at:*** <a href="http://www.phpbb.com/about/features/">http://www.phpbb.com/about/features/</a>
<br />
Since the features are well explained on the official page, I'm just going to highlight the ones I think are the most important for an average person and the ones that make phpBB better than other forum systems:
<br />
>1. Written in PHP
2. phpBB is an open source project, that any developer can contribute to
3. phpBB offers a comprehensive Administration Control Panel which allows you to configure and customise nearly every aspect of your board
4. phpBB is configured for over 100 of the most common spiders and optimises your board when they visit (good for Search Engine Optimization)
5. phpBB offers a very strong Anti-Spam system
6. phpBB follows the latest posting trends using BBCode, Smileys, Attachments and a lot more
7. phpBB's look is fully customizable: download one of the free themes or design your own
8. phpBB supports MySQL, Microsoft SQL, PostgreSQL, Oracle DB, Firebird and SQLite as database storage
9. phpBB and the community offers thousands of free plugins that make customizing phpBB even more easier
<br />

<center><img src="http://f.cl.ly/items/1F0K0S0H0s1Y3Y2X1w3J/Image%202012.07.26%2018:09:45.png" alt="phpBB features" title="" /><br />phpBB features</center>

##Installation
__________
<br />
>An **in-depth guide on installation** can be found here: <a href="http://www.phpbb.com/community/docs/INSTALL.html#quickinstall">Guide on installation</a>
<br />
<center><img src="http://f.cl.ly/items/0L043a3k2Y3V0B3F122j/Image%202012.07.26%2018:56:44.png" alt="phpBB installation guide" title="" /><br />phpBB installation guide</center>	
<br />

##Usage
__________
<br />
>After installing phpBB (3.x), you will find yourself on the index of your brand new forum:
<center><img src="http://f.cl.ly/items/1z0k1q1I1e3f0X392S3s/Image%202012.07.26%2019:07:25.png" alt="phpBB fresh install" title="" /><br />phpBB index</center><br />
<center>***note: you can test every feature mentioned in this guide at phpbb.com/demo***</center>
<br />

###Administration

>Let's just skip to the Administration panel, where you can control your forums, members, plugins, styles and everything else!
The ACP (Administration Control Panel) link can be found on the bottom of the page (after logging is as an admin user, obviously). To ensure only the administrators can log in, you must re-authenticate yourself and voilá, you are inside!
<center><img src="http://f.cl.ly/items/3S2b0r142R2M3E25061e/Image%202012.07.26%2019:16:00.png" alt="phpBB ACP" title="" /><br />phpBB ACP</center><br />
On the '*Admin Index*' you can find the statistics, logs and some other actions you can do. On the top of the screen, below the phpBB logo you can find the main menu bar where you can switch between general administration categories. The default homepage is '*general*'.<br />
Pretty much everything is covered on the usage of the ACP in the documentation, so, again I am going to highlight the main features you must know about as a new forum user:<br />

1. General tab
	- Board settings: configure the site name, site description and other core settings
	- Board features: enable/disable core features
	- User registration settings: everything related registration (ex.:account activation)
	- Server configuration: definitely visit all of the pages under this category and make sure everything looks like you want it to look like
2. Forums
	- Manage forums: add/remove forums/categories
	- Forum permissions: you can promote forum moderators here, change the user permissions and make forums available for a certain group only
3. Posting
	- BBCodes: most people don't use this page as they don't know what it is for, but it is very useful: you can create custom BBCode tags here, which will automatically be implemented to the forum
4. Users & Groups
	- Every category is important here: manage users, groups; ban e-mails/IP addresses
5. Permissions
	- Permissions might see complicated to properly set up, they are actually not -- Please see: <a href="http://www.phpbb.com/support/documentation/3.0/quickstart/quick_permissions.php">http://www.phpbb.com/support/documentation/3.0/quickstart/quick_permissions.php</a> for a reference
6. Styles (more on styles later)
7. Maintenance
	- Forum logs: Admin logs, Moderator logs, User logs
	- Database: Backup or Restore database
8. System
	- Module management: enable/disable certain parts of the control panels
<br />

###Installing styles:

>Please see <a href="http://www.phpbb.com/kb/article/how-to-install-styles-on-phpbb3/">http://www.phpbb.com/kb/article/how-to-install-styles-on-phpbb3/</a> as a reference/tutorial
<br /><center><img src="http://f.cl.ly/items/0J391l0R0D032Q3F3m3t/Image%202012.07.29%2014:52:03.png" alt="phpBB Style DB" title="" /><br />phpBB Style database</center><br />


###Customizing styles:

>As a basic guide, see the official tutorial at: <a href="http://www.phpbb.com/kb/article/how-to-create-a-style-basics/">http://www.phpbb.com/kb/article/how-to-create-a-style-basics/</a><br />
To install a custom theme and to be able to freely modify it, see: <a href="http://www.phpbb.com/kb/article/">http://www.phpbb.com/kb/article/how-to-create-a-new-phpbb3-style/</a><br />
<br />
Obviously, you need to go through every css file to customize all the small parts you want to.
<br />

###Mods:

>phpBB offers a wide-variety of modifications - for free - mainly made by the users to enchant user experience. These modifications are easy to install, easy to maintain and easy to customize.
Most of the plugins include a how-to guide, they should look like the one in this guide: <a href="http://www.phpbb.com/mods/installing/">http://www.phpbb.com/mods/installing/</a><br />

Plugins can be downloaded from several sources, the official one can be found here: <a href="http://www.phpbb.com/customise/db/modifications-1/">http://www.phpbb.com/customise/db/modifications-1/</a>; but of course Google will help you find even more.
<br />
<center><img src="http://f.cl.ly/items/1B0W2U3N2z0d3c062D0O/Image%202012.07.29%2014:53:30.png" alt="phpBB Mods DB" title="" /><br />phpBB Mods database</center><br />

##Conclusion
__________
<br />
>phpBB had several problems with security in the past, but as the system was continuously improved, these issues were permanently fixed. The forum system has became open source and thousands of developers are working on improving security and adding more features every day. phpBB's main opponents were SMF and myBB, but with the release 3.0, phpBB can compete with the non-free vBulletin and IPB forum systems. <br />
If you want to have a secure, but scalable forum system, phpBB is your best option!