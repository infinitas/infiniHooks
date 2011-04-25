#!/usr/bin/env php
<?php
require $_SERVER['PWD'] . '/.git/hooks/config.php';
require $_SERVER['PWD'] . '/.git/hooks/utils.php';

$stagedFiles = stagedFiles();
$tmp = copyFiles($stagedFiles);
if (!is_dir($tmp['dir'])) {
	echo "{$tmp['dir']} doesn't exist";
	exit(1);
}

$args = $config['phpcs'];
foreach($args as $key => &$value) {
	if ($value === true) {
		$value = "$key";
	} else {
		$value = "$key=$value";
	}
}
$cmd = "phpcs " . implode($args, ' ') . " " . escapeshellarg($tmp['dir']);
echo "$cmd\n";
exec($cmd, $output, $return);
if ($return != 0) {
	echo implode("\n", $output), "\n";
	exit(1);
}
