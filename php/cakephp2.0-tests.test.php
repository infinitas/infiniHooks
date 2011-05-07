<?php
define('RUNNING_TESTS', true);
require __DIR__ . '/cakephp2.0-tests.php';

class Cakephp20HookTest extends PHPUnit_Framework_TestCase {

	function testNonPhpFiles() {

		$result = testCase('noextension');
		$this->assertFalse($result);

		$result = testCase('some.sh');
		$this->assertFalse($result);

		$result = testCase('textfile.txt');
		$this->assertFalse($result);

	}

	function testAppFiles() {
	}

	function testPluginFiles() {
	}

	function testCoreFiles() {
	}
}
