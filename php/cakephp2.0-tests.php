#!/usr/bin/env php
<?php

require dirname(__DIR__) .'/utils.php';

function testFile($file) {
	if (!preg_match('@\.php$@', $file) || preg_match('@(config|test_app)[\\\/]@', $file)) {
		return false;
	}
	if (preg_match('@tests[\\\/]@', $file)) {
		if (!preg_match('@\Test\.php$@', $file)) {
			return false;
		}
		$file = str_replace('Test.php', '.php', $file);

		if (preg_match('@.*lib[\\\/]Cake[\\\/]@', $file)) {
			return preg_replace('@.*tests[\\\/]cases[\\\/]@', 'lib' . DS . 'Cake' . DS, $file);
		}
		return preg_replace('@.*tests[\\\/]cases[\\\/]@', $file);
	}
	return $file;
}

$stagedFiles = stagedFiles();
$filename_pattern = '/\.(php)$/';
$toTest = array();
$exit_status = 0;

foreach ($stagedFiles as $file) {
	$file = testFile($file);

	if (!$file) {
		continue;
	}
	$toTest[$file] = true;
}

foreach($toTest as $file) {
	$output = array();
	$cmd = "cake test $file";
	echo "$cmd\n";
	exec($cmd, $output, $return);

	if ($return != 0) {
		echo implode("\n", $output), "\n";
		$exit_status = 1;
	}
}

exit($exit_status);
