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

	$return = array(
		'category' => testCategory($file),
		'case' => str_replace('.php', '', $file),
		'testFile' => false,
		'testFileExists' => false,
	);

	if (preg_match('@tests[\\\/]@', $file)) {
		if (preg_match('@\Test\.php$@', $file)) {
			$return['testFile'] = $file;
			$return['testFileExists'] = true;
			if ($return['case'] = preg_replace('@.*tests[\\\/]cases[\\\/]@', '', $return['case'])) {
				$return['case'] = str_replace('Test', '', $return['case']);
				if ($return['category'] === 'core') {
					$return['case'] = str_replace('lib' . DS . 'Cake' . DS . 'tests' . DS . 'Case' . DS, '', $return['case']);
				}
			}
		}
	} elseif ($return['category'] === 'core') {
		$return['testFile'] = preg_replace('@.*lib[\\\/]Cake[\\\/]@', 'lib/Cake/tests/Case/', $return['case']) . 'Test.php';

		$return['case'] = preg_replace('@.*lib[\\\/]Cake[\\\/]@', '', $return['case']);
		$return['case'][0] = strtoupper($return['case'][0]);
	} else {
		$return['testFile'] = preg_replace(
			'@(.*)((?:(?:config|Console|Controller|Lib|locale|Model|plugins|tests|vendors|View|webroot)[\\\/]).*$|App[-a-z]*$)@',
			'\1tests/Case/\2Test.php',
			$return['case']
		);

		$return['case'] = preg_replace(
			'@.*((?:(?:config|Console|Controller|Lib|locale|Model|plugins|tests|vendors|View|webroot)[\\\/])|App[-a-z]*$)@',
			'\1',
			$return['case']
		);
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
	if (strpos($file, "{$ds}lib{$ds}Cake{$ds}") !== false) {
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
			$cmd = "cake testsuite $category $case";
			echo "$cmd ... \t";
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
	$out = "<?php\ndefine('RUNNING_TESTS', true);\nrequire __DIR__ . '/cakephp2.0-tests.php';\n\n";
	$out .= "class Cakephp20HookTest extends PHPUnit_Framework_TestCase {\n\n\tfunction testTestCase() {\n";
	foreach (files() as $file) {
		$data = testCase($file);

		$out .=  "\n\t\t\$result = testCase('$file');\n";
		if (!$data) {
			$out .=  "\t\t\$this->assertFalse(\$result);\n";
			continue;
		}
		if (!$data['testFile']) {
			$out .=  "\t\t\$this->assertFalse(\$result['testFile']);\n";
			continue;
		}
		$out .=  "\t\t\$this->assertEquals('{$data['category']}', \$result['category']);\n";
		$out .=  "\t\t\$this->assertEquals('{$data['case']}', \$result['case']);\n";
		$out .=  "\t\t\$this->assertEquals('{$data['testFile']}', \$result['testFile']);\n";
	}

	$out .= "\t}\n}";
	file_put_contents('cakephp2.0-tests.test.php', $out);
	echo $out;
}

if (defined('WRITE_TESTS')) {
	writeTest();
} elseif (!defined('RUNNING_TESTS')) {
	$exit = runTestCases();
	exit($exit);
}

