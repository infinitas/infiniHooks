<?php
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

function config($branch = null)  {
	if (!$branch) {
		$branch = trim(`git name-rev --name-only HEAD`);
	}
	require '.git/hooks/config.php';

	if (!empty($config['pre-commit'])) {
		return $config;
	}

	$return = array();

	foreach($config as $pattern => $c) {
		$pattern = str_replace('*', '.*', $pattern);
		if (preg_match("@$pattern@", $branch)) {
			$return += $c;
		}
	}

	return $return;
}

/**
 * Return an array of relative file paths for files contained in the commit
 *
 * If called outside the context of a git hook, return all files
 *
 */
function files() {
	if (!trim(`echo \$GIT_DIR`) && !trim(`echo \$GIT_AUTHOR_NAME`)) {
		$where = '.';
		$locations = $_SERVER['argv'];
		array_shift($locations);
		if ($locations) {
			$where = implode($locations, ' ');
		}
		exec("find $where -type f ! -name '*~' ! -wholename '*.git/*' ! -wholename '*/tmp/*'", $output);
		foreach($output as $i => &$file) {
			if (in_array($i, array('.', '..'))) {
				unset ($output[$i]);
				continue;
			}
			$file = preg_replace('@^\./@', '', $file);
		}
		return array_filter($output);
	}
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
		$name = trim(basename($_SERVER['PWD']));
	}
	$return = array(
		'dir' => "/tmp/$name",
		'files' => array()
	);
	`rm -rf /tmp/$name`;

	if (!trim(`echo \$GIT_DIR`) && !trim(`echo \$GIT_AUTHOR_NAME`)) {
		`cp -R . /tmp/$name`;
		foreach($files as $file) {
			$return['files'][] = "/tmp/$name/$file";
		}
		return $return;
	}

	foreach($files as $file) {
		$dir = dirname($file);
		if (!is_dir("/tmp/$name/$dir")) {
 			`mkdir -p /tmp/$name/$dir`;
		}
		`git cat-file blob $(git diff-index --cached HEAD $file | cut -d " " -f4) > /tmp/$name/$file`;
		$return['files'][] = "/tmp/$name/$file";
	}

	return $return;
}
