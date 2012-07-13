<info>
title: Integrating phpBB sessions into your site
author: callumacrae
date: 1302434340
tags: logins, sessions, phpbb
summary: Instead of having two logins to your site, it would be far easier and more efficient to use phpBB's sessions systems. It would also be easier for your users and more secure. You will also be able to use stuff like the permissions system and the templates system if you wish. In this article, I will explain how you can integrate the phpBB session into your website.
</info>

Instead of having two logins to your site, it would be far easier and more efficient to use phpBB's sessions systems. It would also be easier and more secure for your users. You will also be able to use stuff like the permissions system and the templates system if you wish. In this article, I will explain how you can integrate the phpBB session into your website.

First, you will need to add this to the top of every page you want to use with phpBB's sessions:

	<?php

	define('IN_PHPBB', true);
	$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);
	include($phpbb_root_path . 'common.' . $phpEx);

	// Start session management
	$user->session_begin();
	$auth->acl($user->data);
	$user->setup();

If you wish to include a language file, replace `$user->setup();` with `$user->setup('mods/yourpage');`. This will include `language/yourlang/mods/yourpage.php` automatically and add it to the `$user->lang` array. Obviously, language files are only useful if your website is in more than one language, but it might be worth using it anyway - it gives you the option to expand your site in the future if required.

## The `$user->data` array

`$user->data` contains all information about the user currently stored in the phpbb\_users table (including the password - be careful). For example, a print\_r of the array returns the following on my localhost install:

	Array
	(
		[user_id] => 2
		[user_type] => 3
		[group_id] => 5
		[user_permissions] => zik0zjzik0zjzik0yo
	i1cjyo000000
	zik0zjzhb2tc
	i1cjyo000000
	i1cjyo000000
	i1cjyo000000
	i1cjyo000000
	i1cjyo000000
	i1cjyo000000
	i1cjyo000000
	i1cjyo000000
	i1cjyo000000
	i1cjyo000000
		[user_perm_from] => 0
		[user_ip] => ::1
		[user_regdate] => 1302370816
		[username] => Callum
		[username_clean] => callum
		[user_password] => $H$9CzcNAWt7iLZKDfYPhTJTEnWGBZVTV.
		[user_passchg] => 1302370881
		[user_pass_convert] => 0
		[user_email] => callum@lynxphp.com
		[user_email_hash] => 216925083818
		[user_birthday] => 19- 5-   0
		[user_lastvisit] => 1302370859
		[user_lastmark] => 0
		[user_lastpost_time] => 1302370975
		[user_lastpage] => ucp.php?i=profile&mode=reg_details
		[user_last_confirm_key] =>
		[user_last_search] => 0
		[user_warnings] => 0
		[user_last_warning] => 0
		[user_login_attempts] => 0
		[user_inactive_reason] => 0
		[user_inactive_time] => 0
		[user_posts] => 1
		[user_lang] => en
		[user_timezone] => 0.00
		[user_dst] => 0
		[user_dateformat] => D M d, Y g:i a
		[user_style] => 1
		[user_rank] => 1
		[user_colour] => AA0000
		[user_new_privmsg] => 0
		[user_unread_privmsg] => 1
		[user_last_privmsg] => 1302370975
		[user_message_rules] => 0
		[user_full_folder] => -3
		[user_emailtime] => 0
		[user_topic_show_days] => 0
		[user_topic_sortby_type] => t
		[user_topic_sortby_dir] => d
		[user_post_show_days] => 0
		[user_post_sortby_type] => t
		[user_post_sortby_dir] => a
		[user_notify] => 0
		[user_notify_pm] => 1
		[user_notify_type] => 0
		[user_allow_pm] => 1
		[user_allow_viewonline] => 1
		[user_allow_viewemail] => 1
		[user_allow_massemail] => 1
		[user_options] => 230269
		[user_avatar] =>
		[user_avatar_type] => 0
		[user_avatar_width] => 0
		[user_avatar_height] => 0
		[user_sig] => Hello world!
		[user_sig_bbcode_uid] => 3uemv9wm
		[user_sig_bbcode_bitfield] =>
		[user_from] => England
		[user_icq] =>
		[user_aim] =>
		[user_yim] => dontmessageme
		[user_msnm] => callumacrae@donotwant.spam
		[user_jabber] =>
		[user_website] => http://lynxphp.com/
		[user_occ] =>
		[user_interests] =>
		[user_actkey] =>
		[user_newpasswd] =>
		[user_form_salt] => d60d1c2b19803efa
		[user_new] => 1
		[user_reminded] => 0
		[user_reminded_time] => 0
		[session_id] => bd4bc099bef6f9e2a6c88d16a0538bf9
		[session_user_id] => 2
		[session_forum_id] => 0
		[session_last_visit] => 1302370817
		[session_start] => 1302370817
		[session_time] => 1302371092
		[session_ip] => ::1
		[session_browser] => Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6; en-gb) AppleWebKit/533.19.4 (KHTML, like Gecko) Version/5.0.3 Safari/533.19.4
		[session_forwarded_for] =>
		[session_page] => ucp.php?i=176
		[session_viewonline] => 1
		[session_autologin] => 0
		[session_admin] => 1
		[is_registered] => 1
		[is_bot] =>
	)

It should be fairly obvious what each item is. Everything prefixed with `user_` is from the user table (hence why stuff like user\_password is there).

## Checking whether the user is logged in

The following code will check whether the user is logged in:

	<?php

	if ($user->data['user_id'] == ANONYMOUS) {
		// Not logged in
	} else {
		// Logged in
	}

<p>&nbsp;</p>

For example, if we wanted to make a page members-only:

	<?php

	if ($user->data['user_id'] == ANONYMOUS) {
		trigger_error('You must be logged in to access this page', E_USER_ERROR);
	}

<p>&nbsp;</p>

That's all there is to it. If you want to know more about this, or how to use stuff like the language, permissions, or template system, either check out the [phpBB wiki](http://wiki.phpbb.com/Main_Page) or leave a comment asking me to write an article about it.

Thanks for reading!