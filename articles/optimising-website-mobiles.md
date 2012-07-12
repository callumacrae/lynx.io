<info>
title: Optimising your website for mobile devices
author: callumacrae
date: 1296506820
tags: php, mobile, optimisation, preg_match, theme
summary: Mobile phones are being used to access the Internet with increasing frequency, and as more people buy better phones and mobile Internet gets cheaper, we will find our websites being hit by a greater number of mobile devices. Only one problem: your huge, image heavy design on your forums or blog takes several minutes to load due to slow network speeds, and even then, it uses more resources than the phone has and goes off the screen. Solution? Get a mobile website.
</info>

Mobile phones are being used to access the Internet with increasing frequency, and as more people buy better phones and mobile Internet gets cheaper, we will find our websites being hit by a greater number of mobile devices. Only one problem: your huge, image heavy design on your forums or blog takes several minutes to load due to slow network speeds, and even then, it uses more resources than the phone has and goes off the screen. Solution? Get a mobile website.

A mobile website can benefit you in several ways. First, it will reduce both your and their bandwidth usage. If their bandwidth usage is lower, accessing your site will cost them less so they will be more likely to stay. It is also faster to load, so they are less likely to get bored and stop the page from loading before they have even seen your website. Also, your website will probably display better. There are, however, occasions where a mobile theme is not appropriate. For example, this website does not have a mobile theme. One could be installed pretty easily as I am using WordPress, but I chose not to because of the content - people are unlikely to view this website from their phone.

It is usually very easy to install a mobile theme to your website, as there are many frameworks available already, and if you're using something like WordPress or phpBB there are already olivine written that will do it for you. For WordPress there is WPTouch, and for phpBB there is phpBB Mobile. phpBB Mobile is still in beta, but WPTouch has been around for along time and is a very successful modification. If you're not using a script with a mobile theme already written for it, it isn't very difficult to make on for yourself. When I wrote phpBB Mobile, I used the iWebKit framework. It was designed for iPhone (and other iOS devices), but it also works for other phones. In fact, it works in pretty much any modern smartphone, unless you're using IEMobile. The reason for this is that it uses the standards - HTML and CSS3, mostly. The reason it doesn't work in IEMobile is not the fault of the iWebKit developers, it's the fault of IE as it doesn't support the standards.

You can obviously have separate themes for mobile users and normal users. You can do this by checking their users agents. For example, I use the following regex:

	/iPad|iPhone|iOS|Opera Mobi|BlackBerry|Android|IEMobile|Symbian/

It generally picks up most mobile phones.

Used in combination with a good template system, the following code makes displaying a different style to mobile users extremely easy:

	if (preg_match('/iPad|iPhone|iOS|Opera Mobi|BlackBerry|Android|IEMobile|Symbian/', $_SERVER['HTTP_USER_AGENT'])) {
		// Mobile site here
	} else {
		// Main site here
	}

Feel free to share your mobile site or a mobile site that you think is good in a comment below. Thanks for reading.