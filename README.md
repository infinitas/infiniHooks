Git hooks
=========

Various git hooks, mix and match however you want on a project by project basis.

# Install

Installing this repo is comprised of two steps.

1) Installing the installGitHooks command

	cd this/repo
	./install

OR manually symlink the script installGitHooks into any folder within your path
OR include this repo in your path

2) Using on any project

	cd /any/project/you/like
	installGitHooks

This will symlink the commands you might want to use into your .git/hooks folder - and create a
config file which you can use to customize for each project how the hooks work

# Credits

This repo originally came from http://github.com/s0enke/git-hooks
The php based config etc. originally came from http://github.com/ardell/git-hooks
