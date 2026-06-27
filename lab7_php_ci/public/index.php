<?php

// Define the path to the front controller
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Load the Paths configuration
require dirname(__DIR__) . '/app/Config/Paths.php';

// Path to the system directory
$system_path = realpath(dirname(__DIR__) . '/vendor/codeigniter4/framework/system') ?: dirname(__DIR__) . '/system';

// Define constants
define('SYSTEMPATH', $system_path . DIRECTORY_SEPARATOR);
define('ROOTPATH', realpath(dirname(__DIR__)) . DIRECTORY_SEPARATOR);
define('WRITEPATH', realpath(dirname(__DIR__) . '/writable') . DIRECTORY_SEPARATOR);
define('CONFIGPATH', realpath(dirname(__DIR__) . '/app/Config') . DIRECTORY_SEPARATOR);

// Boot the framework
require SYSTEMPATH . 'bootstrap.php';

// Run the application
exit(CodeIgniter\CodeIgniter::run($app));