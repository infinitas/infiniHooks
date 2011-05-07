#!/usr/bin/env php
<?php

require dirname(__DIR__) .'/utils.php';

/**
 * testCase
 *
 * Find the test case for the passed file. The file could itself be a test.
 *
 * @param mixed $file
 * @access public
 * @return array(type, case)
 */
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
		$testCaseFile = preg_replace('@.*lib[\\\/]Cake[\\\/]@', 'lib/Cake/tests/Case/', $case) . 'Test.php';
		if (!file_exists($testCaseFile)) {
			return array(false, false);
		}

		$case = preg_replace('@.*lib[\\\/]Cake[\\\/]@', '', $case);
		$case[0] = strtoupper($case[0]);
		return array('core', $case);
	} else {
		$testCaseFile = preg_replace(
			'@(.*)((?:(?:config|Console|Controller|Lib|locale|Model|plugins|tests|vendors|View|webroot)[\\\/]).*$|App[-a-z]*$)@',
			'\1tests/Case/\2.Test.php',
			$case
		);
		if (!file_exists($testCaseFile)) {
			return array(false, false);
		}

		$relativeFile = preg_replace(
			'@.*((?:(?:config|Console|Controller|Lib|locale|Model|plugins|tests|vendors|View|webroot)[\\\/])|App[-a-z]*$)@',
			'\1',
			$case
		);
		$baseDir = str_replace($relativeFile, '', $case);
	}

	return array($category, $relativeFile);
}

/**
 * testCategory
 *
 * For the given file, what category of test is it? returns app, core or the name of the plugin
 *
 * @param mixed $file
 * @access public
 * @return string
 */
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


$files = files();
$testCases = array();
$exit = 0;

foreach ($files as $file) {
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
			$exit = 1;
		}
	}
}

exit($exit);
