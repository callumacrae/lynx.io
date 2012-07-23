<info>
title: Security: Cross-Site Scripting (XSS)
author: callumacrae
date: 1331489400
tags: security
summary: Cross-site scripting is a type of vulnerability that affects a surprisingly large number of websites, allowing an attacker to inject HTML into the website. Usually, this would be an iframe or a script, both of which can be dangerous. This article will explore the vulnerability and how you can secure your site against it.
</info>

Cross-site scripting (XSS, CSS was already taken) is a type of vulnerability that affects a surprisingly large number of websites, allowing an attacker to inject HTML into the website. Usually, this would be an iframe or a script, both of which can be dangerous. This article will explore the vulnerability and how you can secure your site against it.

This article is the first in a series of articles on website security. The articles will each take a common security vulnerability, explain how it works and how it is exploited in detail, and then explain what precautions can be taken to prevent your site from being vulnerable.

There are two main types of XSS vulnerability: persistent and non-persistent. The first is far more damaging, but the latter is far more common.

## Persistent

A persistent XSS vulnerability allows the attacker to save malicious code on the server, where it will be served to other people. An example of this would be allowing unfiltered HTML in comments on this blog - someone could enter `<script src="http://example.com/bad.js"></script>` and run their script on my site - for example, they could steal / modify cookies or redirect users to their own site.

## Non-persistent

A non-persistent, or reflected, XSS vulnerability allows the attacker to inject the malicious code only once. It is usually done via the URL. For example, I could link someone to ``register.php?username=%22%3E%3Cscript%20script%20src%3D%22http%3A%2F%2Fexample.com%2Fbad.js%22%3E%3C%2Fscript%3E``, and the following could be outputted:

	<p>Invalid username</p>
	<input type="text" value=""><script script src="http://example.com/bad.js"></script>" />

That would execute the contents of bad.js.

## Prevention

It's pretty easy to prevent cross-site scripting. In general, there are two methods of doing it: you can either remove the HTML, or replace the HTML tags with code like `<script>`.

In PHP, we can remove HTML using the `strip_tags` function. This removes all HTML (including comments). It also allows us to keep some tags using a second parameter - for example, we might want to keep the basic formatting tags such as `<strong>`. This doesn't, however, remove attributes like onmouseover, so that would have to be filtered separately.

	echo strip_tags('<p>Hello world!</p><script src="http://example.com/bad.js"></script>'); // Hello world!
	echo strip_tags('<p>Hello world!</p><script src="http://example.com/bad.js"></script>', '>p>'); // <p>Hello world!</p>

The other option we have in PHP is to use the `htmlspecialchars` function to escape all HTML characters. This means that `<` would be replaced with `&lt;` - when it is outputted, you would be able to see exactly what the user typed as text.

	echo htmlspecialchars('<p>Hello world!</p>'); // &lt;p&gt;Hello world!&lt;/p&gt;

There are some additional options for this function, check out the PHP manual.