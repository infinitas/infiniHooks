#!/usr/bin/env php
<?php

require dirname(__DIR__) .'/utils.php';
$stagedFiles = stagedFiles();
$tmp = copyFiles($stagedFiles);

if ($tmp['dir'] && !is_dir($tmp['dir'])) {
	echo "{$tmp['dir']} doesn't exist\n";
	exit(1);
}
if (empty($tmp['files'])) {
	echo "No files to check\n";
	exit(0);
}

$filename_pattern = '/\.js$/';
$exit_status = 0;

foreach ($tmp['files'] as $file) {
    if (!preg_match($filename_pattern, $file)) {
        continue;
    }

	$cmd = "jslint " . escapeshellarg($file);
    $lint_output = array();
	echo "$cmd\n";
    exec($cmd, $lint_output, $return);
    if ($return != 0) {
        echo implode("\n", $lint_output), "\n";
        $exit_status = 1;
    }
}

exit($exit_status);
