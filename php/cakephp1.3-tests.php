#!/usr/bin/env php
<?php

require $_SERVER['PWD'] . '/.git/hooks/utils.php';

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

	$return = array(
		'category' => testCategory($file),
		'case' => str_replace('.php', '', $file),
		'testFile' => false,
		'testFileExists' => false,
	);

	if (preg_match('@tests[\\\/]@', $file)) {
		if (preg_match('@.test\.php$@', $file)) {
			$return['testFile'] = $file;
			$return['testFileExists'] = true;
			if ($return['case'] = preg_replace('@.*tests[\\\/]cases[\\\/]@', '', $return['case'])) {
				$return['case'] = str_replace('.test', '', $return['case']);
			}
		}
	} elseif ($return['category'] === 'core') {
		$return['testFile'] = preg_replace('@(.*cake[\\\/])@', '\1tests/cases/', $return['case']) . '.test.php';
		$return['case'] = str_replace(
			'/',
			DIRECTORY_SEPARATOR,
			preg_replace('@.*cake[\\\/]?@', '', $return['case'])
		);
	} else {
		$return['testFile'] = preg_replace(
			'@(.*)((?:(?:config|controllers|libs|locale|models|plugins|tests|vendors|views)[\\\/]).*$|app[-a-z]*$)@',
			'\1tests/cases/\2.test.php',
			$return['case']
		);

		$return['case'] = preg_replace(
			'@.*((?:(?:config|controllers|libs|locale|models|plugins|tests|vendors|views)[\\\/]).*$|app[-a-z]*$)@',
			'\1',
			$return['case']
		);

		$map = array(
			'controllers/components' => 'components',
			'models/behaviors' => 'behaviors',
			'models/datasources' => 'datasources',
			'views/helpers' => 'helpers',
			'vendors/shells' => 'shells',
		);
		foreach ($map as $path => $_type) {
			if (strpos($return['case'], $path) === 0) {
				$path = str_replace(
					'/',
					DIRECTORY_SEPARATOR,
					$path
				);

				$return['case'] = str_replace($path, $_type, $return['case']);
				break;
			}
		}
	}

	if ($return['category'] === 'core') {
		$return['case'] = str_replace('lib/', '', $return['case']);
	}

	$return['testFileExists'] = file_exists($return['testFile']);
	return $return;
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
	if (strpos($file, "cake{$ds}") !== false) {
		return 'core';
	} elseif (preg_match('@plugins[\\\/]([^\\/]*)@', $file, $match)) {
		return $match[1];
	}
	return 'app';
}

function testCases($files = null) {
	$return = array();

	if (is_null($files)) {
		$files = files();
	}
	foreach ($files as $file) {
		$data = testCase($file);

		if ($data === false || !$data['testFile']) {
			continue;
		}
		if (!$data['testFileExists']) {
			echo "Skipping $file (test case {$data['testFile']} not found)\n";
			continue;
		}
		$return[$data['category']][$data['case']] = true;
	}
	return $return;
}

function runTestCases($files = null) {
	$exit = 0;
	foreach(testCases($files) as $category => $cases) {
		foreach(array_keys($cases) as $case) {
			$output = array();
			$cmd = "cake testsuite $category case $case";
			$time = date("H:m:s");
			echo "[$time] $cmd ... \t";
			exec($cmd, $output, $return);
			if ($return != 0) {
				echo "\n" . implode("\n\t", $output), "\n";
				$exit = 1;
			} else {
				echo "OK\n";
			}
		}
	}
	return $exit;
}

function writeTest() {
	$out = "<?php\ndefine('RUNNING_TESTS', true);\nrequire __DIR__ . '/cakephp1.3-tests.php';\n\n";
	$out .= "class Cakephp13HookTest extends PHPUnit_Framework_TestCase {\n\n\tfunction testTestCase() {\n";
	foreach (files() as $file) {
		$data = testCase($file);

		if (!$data) {
			continue;
		}

		$out .=  "\n\t\t\$result = testCase('$file');\n";
		if (!$data['testFile']) {
			$out .=  "\t\t\$this->assertFalse(\$result['testFile']);\n";
			continue;
		}
		$out .=  "\t\t\$this->assertEquals('{$data['category']}', \$result['category']);\n";
		$out .=  "\t\t\$this->assertEquals('{$data['case']}', \$result['case']);\n";
		$out .=  "\t\t\$this->assertEquals('{$data['testFile']}', \$result['testFile']);\n";
	}

	$out .= "\t}\n}";
	file_put_contents('cakephp1.3-tests.test.php', $out);
	echo $out;
}

if (defined('WRITE_TESTS')) {
	writeTest();
} elseif (!defined('RUNNING_TESTS')) {
	$exit = runTestCases();
	exit($exit);
}

