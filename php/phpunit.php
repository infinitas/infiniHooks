#!/usr/bin/env php
<?php

if (!file_exists('tests/smoke.test.php')) {
	exit(0);
}

$output = array();
$return = 0;
$exit = 0;
exec("phpunit --stop-on-failure tests/smoke.test.php", $output, $return);

if ($return != 0) {
	echo implode("\n", $output) . "\n";
	$exit = 1;
	exit($exit);
}
