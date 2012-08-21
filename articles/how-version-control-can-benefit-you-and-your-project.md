<info>
title: How version control can benefit you and your project
author: callumacrae
date: 1309434540
tags: svn, git, version control
summary: You may have heard of version control (sometimes called revision control or source control), or you may have even used it briefly before, but never actually used it as part of a project. Some examples of version control systems are Git (my personal favourite), SVN and Mercurial. In this article I will explain how the use of one of these version control systems can benefit your project.
</info>

You may have heard of version control (sometimes called revision control or source control), or you may have even used it briefly before, but never actually used it as part of a project. Some examples of version control systems are Git (my personal favourite), SVN and Mercurial. In this article I will explain how the use of one of these version control systems can benefit your project.

Version control in its purest form simply allows you to track changes made to files (in this case, the source files for your website). Every time you make a change, you "commit" the change. A commit will include a description of the changes, too, allowing you to easily look back and see what happened in that change. This can also make it a lot easier to generate changelogs, as you can just copy the commit descriptions. You can also easily roll back to a previous commit - say, for example, that you broke something and want to roll back to the last working change, you can generally do it in one command (`git reset --hard HEAD` in git).

You can push your commits to remote repositories, making it perfect for collaborative work - everyone is working on the same code, and you can push your changes to the remote repository and pull other peoples changes when they push them. Most version control systems are incredibly good at merging changes - that is, if two people change the same file, it will merge the changes. It also makes it easy for the people paying you to see what you're doing, and track how fast you're doing it (okay, maybe that isn't such a good thing sometimes).

You can create "branches" on projects, allowing you to make big changes with multiple commits without actually touching the "master" branch. When you're done, you can merge it back into master. Say, for example, that you're building a bulletin board system along with a couple other developers, and you want to add a shout-box to it. To do this, you would create a branch called "shoutbox" (or something like that), and make your changes in that branch. Then, when you're done and the other developers approve of it, you can merge it back into the master repo and the shout-box will be added to the core code. Branching has the advantage that other people can see what you're doing (and test whether it works) while working on the same project, but without it affecting their code. It's also a lot cleaner than everyone hacking at the same branch at the same time.

Version control allows you to see exactly who wrote what code and when. If, for example, some broken code is found in the master branch, you can run "blame" on the code, and your version control system will tell you exactly who wrote what code. For example, in index.php on the phpBB repo on GitHub:

![GitHub blame](http://f.cl.ly/items/3D0n0b1o3c2P461o243A/Screen%20shot%202011-05-22%20at%2012.41.48.png)

From this, you can see exactly who wrote that code, and can get them to fix their own code.

Tagging allows you to mark your code with a version number, for example 1.0.0 or 11.04. This is a lot more efficient than having a directory of files with names like "project-1.0.0.zip", "project-1.0.1.zip", is a lot easier to manage, and is a lot easier to access. It also uses a lot less space - version control systems don't store the entire project at each stage, they store the diffs of the files before and after each commit. If you edit one line of a 10,000 line project, it doesn't store 10,000 lines, it only stores 2 or 3. This is, as you can imagine, a lot faster.

<p>&nbsp;</p>

There are more features that are specific to each version control system, and I would recommend that you check one out, especially if you are working collaboratively. I may publish an article soon about the pros and cons of each specific version control system, it depends on the response to this article.