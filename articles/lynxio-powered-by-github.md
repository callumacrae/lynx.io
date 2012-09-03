<info>
title: lynx.io: Powered by GitHub
author: callumacrae
date: %date%
tags: lynx.io, github, deployment
summary: This article is the first in a couple articles on the new lynx.io website. This article is entitled "lynx.io: Powered by GitHub", and is about how we use GitHub's Pull Request mechanism to accept, review and comment on new articles.
</info>

This article is the first in a couple articles on the new lynx.io website. This article is entitled "lynx.io: Powered by GitHub", and is about how we use GitHub's Pull Request mechanism to accept, review and comment on new articles.


## Background

I recently rewrote the lynx.io website (then called lynxphp; I renamed it when I launched the new backend and design) so that I wouldn't have to use WordPress anymore. The new site uses PHP and quite a bit of JavaScript, and articles are written in MarkDown, which I prefer for writing over HTML or BBCode (GitHub also uses MarkDown for READMEs, and comments on issues and code). Articles are stored in static files in the articles directory and indexed by the articles.json file (again in that directory), which means that there is no need for a database at all. That was a bit tricky for stuff like searching and comments, but I will cover that in another article at a later date.


## Adding articles manually

To add an article to the website, two things have to be done:

1. Article file created and populated - except for an `<info>` section at the top of the file containing basic information on the article such as title, date and tags, everything in here is just MarkDown.
2. Article information - everything in the `<info>` section of the article, plus the slug from the filename - has to be added to `articles/articles.json`.

It then just has to be committed to Git, pushed to [the repo](https://github.com/callumacrae/lynx.io) on GitHub, and pulled down to the server. Comment files are created automatically when someone leaves a comment, and nothing else needs to be done.


## Automating adding articles

I started thinking about alternative ways that I could have articles submitted so that if someone sent me an article, they wouldn't have to add the article to articles.json, and I wouldn't have to add it when they accepted it. This could be done in either of two ways:

- There could be a script which checked the list of files in the articles directory against articles.json - if an article is in the articles directory but not articles.json, then it hasn't been added yet and it could be added. This would either be run on a cron job, or on a Git hook.
- There could be a script which parses the output of `git pull origin master`, seeing if any articles had been added to the articles directory. It could then add the article. Again, this could be ran on either a cron job or a Git hook.

I started developing based upon the first point, but I found as I was running `git pull origin master` in it anyway as it was running on a Git hook, I had all the information I needed. It was far more efficient to just parse the output of that command than to list every file in the directory, which wouldn't have been too efficient as the site got bigger.

I wrote a fairly simple script to run the pull and add the article. At that point, I was only running it through the command line so that I could check the output and make sure that it didn't break anything - I didn't want it running by itself in the middle of the night and breaking the site when I wasn't around to fix it. The plan was that once it was working correctly, I would add it as a service hook on GitHub, so that whenever I pushed to the repository it would send a request to a specific URL on the website, which would run the script. Once I had finished the script, it did three things:

- First, it ran `git pull origin master`, saving the output to a variable.
- Then, it scanned that variable for `create mode \d+ articles\/([a-z0-9_-]+)\.md`. That would detect whether any article files had been added in that commit, and save any matches to another variable.
- Finally, it would work its way through all the article files that had been added, adding them to article.json and caching the article file (it would be done on the first request anyway, but this speeds up the first request a fraction).

The entire file (build.php, which you can see on the repo) is 69 lines long, most of which is caching the articles.

When I was happy that the file worked as expected, I added the URL as a service hook on GitHub, and tested it with a few articles. It worked!


## Other advantages to using GitHub

There is one very obvious advantage to using GitHub: it means that the entire lynx.io website is open source. I'm quite proud of it, so it allows people to see exactly what I have done and how I have done it. This article wouldn't really work if you couldn't see the source! It also forces me to write good code, and allows other people to adapt it for their own websites if they want to (note: if you're going to do this, please change the design!).

The other huge advantage is the pull request system that GitHub offers. Whenever someone wants to submit an article, they just have to add the article file to the articles directory and send a pull request. Previously, they would have had to send me an email, and then I would have had to create them a WordPress account which they would have had to confirm, and then I could have given it permissions to write articles. Then once they had written their article, they would have had to send me yet another email to let me know that they had finished. If there were any mistakes in the article or I had any suggestions, it could have led to a potentially massive amount of emails over multiple days. With GitHub pull requests, I can leave comments inline on the pull request, in the exact place where the errors occur or I think that there could be improvement made.

![Inline comments]({{ articleimages }}/inline-comments.png)

It also allows me to see the changes, instead of having to reread the entire article like I had to with WordPress.

![Diff]({{ articleimages }}/diff.png)


## Summary

GitHub has completely changed the process of writing for lynx.io. It has made it a lot easier to submit and review articles, and without having to push loads of buttons to add it to the website.

lynx.io: Powered by GitHub!

<p>&nbsp;</p>

Feel free to submit an article to see how the process works. No article is too short, as long as it is good quality and about website development or design. Check out the README at the root of the repository fo more information.
