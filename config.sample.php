<?php

$config = array(
	'pre-commit' => array(
		'php/lint.php',
		'php/phpcs.php',
		'php/phpunit.php',
	),
	'post-commit' => array(
		'misc/happy-commits',
	),
);

$config['phpcs'] = array(
	'-n' => true,
	'-s' => true,
	'--extensions' => 'php,ctp',
	'--encoding' => 'UTF-8',
	'--standard' => 'Cake',
	'--report-width' => `tput cols`
);
