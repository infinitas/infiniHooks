#!/usr/bin/env php
<?php
require $_SERVER['PWD'] . '/.git/hooks/utils.php';
$config = config();

if(onlyDeleting()){
	exit(0);
}

$files = files();

$fail = false;

function get_test_classes($php_code) {
	$parents = array('AppModelTestCase', 'AppControllerTestCase', 'AppBehaviorTestCase', 'AppComponentTestCase');
	$classes = array();
	$tokens = token_get_all($php_code);
	$count = count($tokens);
	
	$currentClass = 0;
	$stack = 0;
	
	for($i = 0; $i < $count; $i++) {
		if($tokens[$i] == '{') {
			$stack++;
			continue;
		}
		
		if($tokens[$i] == '}') {
			$stack--;
			continue;
		}
		
		if($tokens[$i][0] == T_CLASS) {
			$currentClass++;

			$className = $tokens[$i+2][1];

			if($tokens[$i+4][0] == T_EXTENDS) {
				$extends = $tokens[$i+6][1];
			} else {
				$extends = false;
			}

			$classes[$currentClass] = array(
				'name' => $className,
				'extends' => $extends,
				'hasDebugVar' => false
			);

			continue;
		}

		if($stack == 1 && $tokens[$i][0] == T_VARIABLE && $tokens[$i][1] == '$tests' && $tokens[$i+4][1] != 'false') {
			$classes[$currentClass]['hasDebugVar'] = $tokens[$i][2];
		}
	}
	
	foreach($classes as $i => $class) {
		if(!$class['extends'] || !in_array($class['extends'], $parents)) {
			unset($classes[$i]);
		}
	}
	
	return $classes;
}

foreach($files as $file) {
	/* Validating stuff in test cases */
	if(strrpos($file, '.test.php')) {
		$content = file_get_contents($file);
		$classes = get_test_classes($content);
		
		foreach($classes as $class) {
			if($class['hasDebugVar']) {
				$fail = true;

				echo 'remove the $tests variable in ' . $file . ' (line '. $class['hasDebugVar'] . ")\n";
			}
		}
	}
}

if($fail) {
	exit(1);
}

exit(0);