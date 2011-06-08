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

This will symlink the commands you might want to use into your .git/hooks folder, link all githooks to the one-hook file, and create a config file which you can use to customize how the hooks work
for each project

3) Other requirements

	the CakePHP coding standards for PHPCodeSniff can be found at http://github.com/AD7six/cakephp-codesniffs

# Version History


2.0.0	Rewritten to be PHP and configuration based

1.0.0	Initial release, mostly bash scripts

# Credits

This repo originally came from http://github.com/s0enke/git-hooks

The php based config etc. originally came from http://github.com/ardell/git-hooks

