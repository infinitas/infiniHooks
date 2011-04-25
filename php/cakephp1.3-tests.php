#!/usr/bin/env php
<?php

require dirname(__DIR__) .'/utils.php';

function testCase($file) {
	if (!preg_match('@\.php$@', $file) || preg_match('@(config|test_app)[\\\/]@', $file)) {
		return false;
	}
	$category = testCategory($file);
	$case = str_replace('.php', '', $file);
	if (preg_match('@tests[\\\/]@', $file)) {
		if (preg_match('@\Test\.php$@', $file)) {
			if ($case = preg_replace('@.*tests[\\\/]cases[\\\/]@', '', $case)) {
				$case = str_replace('Test', '', $case);
				if ($category === 'core') {
					$case = str_replace('lib' . DS . 'Cake' . DS . 'tests' . DS . 'Case' . DS, '', $case);
				}
				return array($category, $case);
			}
		}
		return array(false, false);
	}
	if ($category === 'core') {
		$case = preg_replace('@.*lib[\\\/]Cake[\\\/]@', '', $case);
		$case[0] = strtoupper($case[0]);
		return array('core', $case);
	} else {
		$relativeFile = preg_replace('@.*((?:(?:config|Console|Controller|Lib|locale|Model|plugins|tests|vendors|View|webroot)[\\\/])|App[-a-z]*$)@', '\1', $case);
		$baseDir = str_replace($relativeFile, '', $case);
	}

	return array($category, $relativeFile);
}

function testCategory($file) {
	$_file = realpath($file);
	if ($_file) {
		$file = $_file;
	}

	$ds = DIRECTORY_SEPARATOR;
	if (strpos($file, "{$ds}lib{$ds}Cake{$ds}") !== false) {
		return 'core';
	} elseif (preg_match('@plugins[\\\/]([^\\/]*)@', $file, $match)) {
		return $match[1];
	}
	return 'app';
}


$stagedFiles = stagedFiles();
$filename_pattern = '/\.(ctp|php)$/';
$testCases = array();
$exit_status = 0;

foreach ($stagedFiles as $file) {
    if (!preg_match($filename_pattern, $file)) {
        // don't check files that aren't PHP
        continue;
    }
	list($category, $case) = testCase($file);

	if (!$case) {
		continue;
	}
	$testCases[$category][$case] = true;
}

foreach($testCases as $category => $cases) {
	foreach(array_keys($cases) as $case) {
		$output = array();
		$cmd = "cake testsuite $category $case";
		echo "$cmd\n";
    	exec($cmd, $output, $return);

		if ($return != 0) {
			echo implode("\n", $output), "\n";
			$exit_status = 1;
		}
	}
}

exit($exit_status);
