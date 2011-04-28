#!/usr/bin/env php
<?php

require dirname(__DIR__) .'/utils.php';

$files = files();
$tmp = copyFiles($files);

$return = 0;
$exit_status = 0;

foreach ($tmp['files'] as $file) {
    // finds any DOS carriage returns, but ignores .git directory
    // REGEX from:  http://stackoverflow.com/questions/73833/how-do-you-search-for-files-containing-dos-line-endings-crlf-with-grep-under-li
    $cmd = "grep -PIlsr '\\r\\n' {$file}";

    $output = array();
    exec($cmd, $output, $return);
    if ($return != 1) {
        echo "DOS line endings detected\n" . implode("\n", $output) . "\n";
        $exit_status = 1;
    }
}

exit($exit_status);

/**
 * bash script to fix dos files:
 * WARNING:  this overwrites files in place
 *
 *     for f in `grep -PIlsr '\r\n' . | grep -v '.git'`; do dos2unix ${f}; done
 *
 **/
