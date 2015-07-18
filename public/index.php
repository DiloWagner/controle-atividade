<?php
header('Access-Control-Allow-Origin: *');
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

$protocol = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
$alias = isset($_SERVER['REDIRECT_BASE']) ?  substr_replace($_SERVER['REDIRECT_BASE'], '', -1) : null;

define('BASE_URL', sprintf('%s://%s%s', $protocol, $_SERVER['HTTP_HOST'], $alias));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
