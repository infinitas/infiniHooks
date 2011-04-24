<?php

/**
 * Return an array of relative file paths for files contained in the commit
 *
 */
function stagedFiles() {
	$output = array();
	exec('git rev-parse --verify HEAD 2> /dev/null', $output, $return);
	if ($return === 0) {
		$against = 'HEAD';
	} else {
		$against = '4b825dc642cb6eb9a060e54bf8d69288fbee4904';
	}

	$output = array();
	exec("git diff-index --cached --name-only $against", $output);

	return array_filter($output);
}

/**
 * Return an array of absolute file paths to copies of files contained in the commit
 * A copy is useful to ignore unstage changes
 *
 */
function copyFiles($files, $name = null) {
	if (!$name) {
		$name = basename(getcwd());
	}
	$return = array(
		'dir' => "/tmp/$name",
		'files' => array()
	);

	`rm -rf /tmp/$name`;
	foreach($files as $path) {
		$dir = dirname($path);
 		`mkdir -p /tmp/$name/$dir`;
		`git cat-file blob $(git diff-index --cached HEAD $path | cut -d " " -f4) > /tmp/$name/$path`;
		$return['files'][] = "/tmp/$name/$path";
	}

	return $return;
}
