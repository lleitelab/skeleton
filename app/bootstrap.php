<?php

use \Service\View;
use \Respect\Rest\Router;

error_reporting(E_ALL);

define('PATH_SETTINGS', realpath(__DIR__ . '/../settings/'));

// auto Loader initialize
require_once realpath(__DIR__ . '/../vendor/autoload.php');

// set Respect Router
$router = new Router();

// configuration initialize


// Routines
session_start();

// initialize avaliable routes of modules
$path = realpath(__DIR__);
$modulesDir = new DirectoryIterator($path);

// finding route file in modules 
foreach ($modulesDir as $dir) {
    if ($dir->isDir() && !$dir->isDot()) {
        $routesFile = $dir->getPathname() . '/routes.php';
        if (file_exists($routesFile)) {
            include $routesFile;
        }
    }
}

echo $router->dispatch()->response();