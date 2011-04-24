<?php

$CONFIG = array(
    'preCommit' => array(
        'run-php-lint',
        'enforce-coding-standards',
        'run-phpunit',
    ),
    'postCommit' => array(
        'happy-commits',
    ),
);

$CONFIG['phpcs'] = array(
	'-n' => true,
	'-s' => true,
	'--extensions' => 'php,ctp',
	'--encoding' => 'UTF-8',
	'--standard' => 'Cake',
	'--report-width' => `tput cols`
);
