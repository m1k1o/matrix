<?php
ob_start();

// Define PROJECT PATH
define('LIB_PATH', 'lib');
define('PROJECT_PATH', dirname(__FILE__));

// Load Autoloader
require LIB_PATH.DIRECTORY_SEPARATOR."splclassloader.class.php";
$classLoader = new SplClassLoader(null, PROJECT_PATH.DIRECTORY_SEPARATOR.LIB_PATH);
$classLoader->setFileExtension('.class.php');
$classLoader->register();

// Show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start Session
session_start();