<?php

$config = array(
	'pre-commit' => array(
		'php/lint',
		'php/phpcs',
		'php/phpunit',
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
