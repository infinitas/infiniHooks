#!/usr/bin/env php
<?php

require dirname(__DIR__) .'/utils.php';
$stagedFiles = stagedFiles();
$tmp = copyFiles($stagedFiles);

if (empty($tmp['files'])) {
	echo "No files to check\n";
	exit(0);
}
if ($tmp['dir'] && !is_dir($tmp['dir'])) {
	echo "{$tmp['dir']} doesn't exist\n";
	exit(1);
}


$pattern = '/\.php$/';
$status = 0;

foreach ($tmp['files'] as $file) {
	if (!preg_match($pattern, $file)) {
		continue;
	}

	$cmd = "php -l " . escapeshellarg($file);
	$output = array();
	echo "$cmd\n";
	exec($cmd, $output, $return);
	if ($return != 0) {
		echo implode("\n", $output), "\n";
		$status = 1;
	}
}

exit($status);
