#!/usr/bin/env php
<?php

require dirname(__DIR__) .'/utils.php';
$files = files();
$tmp = copyFiles($files);

if (empty($tmp['files'])) {
	echo "No files to check\n";
	exit(0);
}

if ($tmp['dir'] && !is_dir($tmp['dir'])) {
	echo "{$tmp['dir']} doesn't exist\n";
	exit(1);
}

$filename_pattern = '/\.js$/';
$exit_status = 0;

foreach ($tmp['files'] as $file) {
    if (!preg_match($filename_pattern, $file)) {
        continue;
    }

	$cmd = "jslint -p " . escapeshellarg($file);
    $lint_output = array();
	echo "$cmd\n";
    exec($cmd, $lint_output, $return);
    if ($return) {
        echo implode("\n", $lint_output), "\n";
        $exit_status = 1;
    }
}

exit($exit_status);
