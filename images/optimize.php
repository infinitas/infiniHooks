#!/usr/bin/env php
<?php

require $_SERVER['PWD'] . '/.git/hooks/utils.php';
$config = config();

$files = files();

$hasImages = false;
$saving = 0;

foreach ($files as $file) {
	if (!is_file($file) || !preg_match('/\.(bmp|gif|jpe?g|png)$/i', $file)) {
		continue;
	}

	$sizeOrig = filesize($file);

	if ($sizeOrig < 10000) {
		continue;
	}

	$hasImages = true;

	$tmp = tempnam('/tmp', 'img_');

	$file = escapeshellarg($file);
	if (preg_match('/\.png$/i', $file)) {
		$cmd = "pngcrush -reduce -brute -fix -f 5 $file $tmp > /dev/null 2>&1";
	} else {
		$cmd = "convert $file -quality 80 $tmp";
	}

	echo "\t$cmd\n";
	exec($cmd);

	$sizeOpt = filesize($tmp);
	$diff = $sizeOrig - $sizeOpt;
	if ($diff) {
		$percent = number_format(100 * $diff / $sizeOrig, 2);
	}
	if ($sizeOpt) {
		if ($diff > 5000 && $percent > 5) {
			exec("mv $tmp $file");

			$saving += $diff;

			if ($percent > 50) {
				$percent = "****$percent****";
			}
			echo "\t\t$sizeOrig bytes -> $sizeOpt bytes. Removed $diff bytes ($percent%)\n";
		} else {
			unlink($tmp);
			echo "\t\tNo significant saving\n";
		}
	} else {
		unlink($tmp);
		echo "\t\tNo saving\n";
	}
}

if ($hasImages && $saving) {
	echo "\nFinished, removed $saving bytes";
}
