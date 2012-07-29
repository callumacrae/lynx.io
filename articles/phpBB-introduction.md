<info>
title: Introduction to phpBB
author: dida
date: %date%
tags: phpbb, introduction, themes, style, installation, administration, guide
summary: In this article, I will introduce you to the core features of phpBB and guide you through the installation.
</info>

## Contents:
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

## Introduction to phpBB

### Quotations

- phpbb.com: 
> phpBB is a free flat-forum bulletin board software solution that can be used to stay in touch with a group of people or can power your entire website. With an extensive database of user-created modifications and styles database containing hundreds of style and image packages to customise your board, you can create a very unique forum in minutes

- wikipedia.com: 
> phpBB is a popular Internet forum package written in the PHP scripting language. The name "phpBB" is an abbreviation of PHP Bulletin Board. Available under the GNU General Public License, phpBB is free and open source software.


### History and future

#### History

phpBB was started on June 17, 2000 by James Atkinson who was planning to to make a simple UBB (ultimate bulletin board)-like for for his own website. Later, two other developers joined the team and the work on 1.0.0 began.
phpBB 1.0.0 was released on December 16, 2000. During the development of this version, several more developers joined the project and the forum has gone through a huge improvement.

![phpBB 1.0]({{ articleimages }}/phpbb1.png)

In February 2001, the development of phpBB started again and was released on April 4, 2001 (originally the developers planned to release it on April 1).<br />
The improvements continued and in January 2005 lead developer Paul Owen announced that due to the lack of backward compatibility with phpBB 2.0.x the new version would be named phpBB3. Following seven months in the release candidate stage, phpBB 3.0.0 was officially released on December 13, 2007.

Source: [phpBB.com](http://phpbb.com/about/history) and [Wikipedia.com](http://wikipedia.com)


#### Future

Nils Adermann (naderman) assumed the role of Development Team Leader in January 2010 and the future is bright for phpBB with an open, community-focused method of development. In addition to the continued development of phpBB 3.0 “Olympus” and phpBB 3.1 “Ascraeus”, planning has also begun for future releases 3.2 “Arsia” and 4.0 “Rhea”.
<br />

## Features
__________

***A list of all the features can be found on the official phpBB website at:*** [http://www.phpbb.com/about/features/](http://www.phpbb.com/about/features/)

Since the features are well explained on the official page, I'm just going to highlight the ones I think are the most important for an average person and the ones that make phpBB better than other forum systems:

1. Written in PHP
2. phpBB is an open source project, meaning that any developer can contribute to it
3. phpBB offers a comprehensive Administration Control Panel which allows you to configure and customise nearly every aspect of your board
4. phpBB is configured for over 100 of the most common spiders and optimises your board when they visit (good for Search Engine Optimization)
5. phpBB offers a very strong Anti-Spam system
6. phpBB follows the latest posting trends using BBCode, Smileys, Attachments and a lot more
7. phpBB's look is fully customizable: download one of the free themes or design your own
8. phpBB supports MySQL, Microsoft SQL, PostgreSQL, Oracle DB, Firebird and SQLite as database storage
9. phpBB and the community offers thousands of free plugins that make customizing phpBB even more easier
<br />

## Installation
__________

An **in-depth guide on installation** can be found [here](http://www.phpbb.com/community/docs/INSTALL.html#quickinstall)


## Usage
__________

After installing phpBB (3.0.x), you will find yourself on the index of your brand new forum:
![phpBB index page]({{ articleimages }}/bindex.png)

***Note: you can test every feature mentioned in this guide at [the demo page](http://phpbb.com/demo)***


### Administration

Let's just skip to the Administration panel, where you can control your forums, members, plugins, styles and everything else!
The ACP (Administration Control Panel) link can be found on the bottom of the page (after logging is as an admin user, obviously). To ensure only the administrators can log in, you must re-authenticate yourself and voilá, you are inside!
![phpBB admin control panel]({{ articleimages }}/aindex.png)
On the '*Admin Index*' you can find the statistics, logs and some other actions you can do. On the top of the screen, below the phpBB logo you can find the main menu bar where you can switch between general administration categories. The default homepage is '*general*'.<br />
Pretty much everything is covered on the usage of the ACP in the documentation, so, again I am going to highlight the main features you must know about as a new forum user:<br />

1. General tab
	- Board settings: configure the site name, site description and other core settings
	- Board features: enable/disable core features
	- User registration settings: everything related to registration (e.g.:account activation)
	- Server configuration: definitely visit all of the pages under this category and make sure everything looks like you want it to look like
2. Forums
	- Manage forums: add/remove forums/categories
	- Forum permissions: you can promote forum moderators here, change the user permissions and make forums available for a certain group only
3. Posting
	- BBCodes: a lot of people don't use this page as they don't know what it is for, but it is very useful: you can create custom BBCode tags here, which will automatically be implemented to the forum
4. Users and Groups
	- Every category is important here: "Manage users", "Manage groups"; ban e-mails/IP addresses
5. Permissions
	- Permissions might see complicated to properly set up, they are actually not -- please see: [http://www.phpbb.com/support/documentation/3.0/quickstart/quick_permissions.php](http://www.phpbb.com/support/documentation/3.0/quickstart/quick_permissions.php) for a reference
6. Styles (more on styles later)
7. Maintenance
	- Forum logs: Admin logs, Moderator logs, User logs
	- Database: Backup and Restore database
8. System
	- Module management: enable/disable certain parts of the control panels and add new modules to the system


### Installing styles

Please see [http://www.phpbb.com/kb/article/how-to-install-styles-on-phpbb3/](http://www.phpbb.com/kb/article/how-to-install-styles-on-phpbb3/) as a reference/tutorial

![phpBB style database]({{ articleimages }}/styles.png)


### Customizing styles

As a basic guide, see the official tutorial at: [http://www.phpbb.com/kb/article/how-to-create-a-style-basics/](http://www.phpbb.com/kb/article/how-to-create-a-style-basics/)

To install a custom theme and to be able to freely modify it, see: [http://www.phpbb.com/kb/article/how-to-create-a-new-phpbb3-style/](http://www.phpbb.com/kb/article/how-to-create-a-new-phpbb3-style/)

Obviously, you need to go through every CSS file to customize all the small parts you want to.


### Modifications

phpBB offers a wide variety of free modifications made mainly by the users, to enhance user experience. These modifications are easy to install, easy to maintain and easy to customize.
Most of the plugins include a how-to guide, they should look like the one in this guide: [http://www.phpbb.com/mods/installing/](http://www.phpbb.com/mods/installing/)

Plugin installation is made even easier, with a tool called AutoMOD. This tool is designed to  parse and automatically install MODX MODifications for phpBB3. It also has the ability to uninstall MODs.
All the MODs listed in the MOD Database (see below) do support AutoMOD. If you are interested in using AutoMOD, see [http://www.phpbb.com/mods/automod/](this page).

Plugins can be downloaded from several sources, the official one can be found here: [http://www.phpbb.com/customise/db/modifications-1/](http://www.phpbb.com/customise/db/modifications-1/); but of course Google will help you find even more.

![phpBB mods database]({{ articleimages }}/modifications.png)

## Conclusion
__________

phpBB's system was continuously improved in the past few years and it is now known as the best free forum system. It has become open source and hundreds of developers are working on improving security and adding more features every day. phpBB's main opponents were SMF and myBB, but with the release 3.0, phpBB can compete with the non-free vBulletin and IPB forum systems.

If you want to have a secure and scalable forum system, phpBB is your best choice!
