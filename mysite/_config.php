<?php

global $project;
$project = 'mysite';

// use the _ss_environment.php file for configuration
require_once ('conf/ConfigureFromEnv.php');

// remove the auto generated SS_ prefix that gets added if database is auto detected
global $databaseConfig;
$databaseConfig['database'] = str_replace('SS_', '', $databaseConfig['database']);


// set default language
i18n::set_locale('en_US');

// Force redirect to www
Director::forceWWW();

define('PROJECT_THIRDPARTY_DIR', project() . '/thirdparty');
define('PROJECT_THIRDPARTY_PATH', BASE_PATH . '/' . PROJECT_THIRDPARTY_DIR);
