<?php

use \Service\View;
use \Respect\Rest\Router;

error_reporting(E_ALL);
set_include_path(
        get_include_path() . PATH_SEPARATOR .
        realpath(__DIR__ . '/../Vendor') . PATH_SEPARATOR .
        realpath(__DIR__)
);

define('PATH_SETTINGS', realpath(__DIR__ . '/../settings/'));

// auto Loader initialize
require_once realpath(__DIR__ . '/../Vendor/Respect/Loader.php');
spl_autoload_register(new Respect\Loader());

// set base of template path
View::setTemplatePath(realpath(__DIR__ . '/../resources/template/'));
$router = new Router();

// configuration initialize


// Routines
session_start();
$function = function() {
            
        };

View::addRoutineToExecuteBeforeRender($function);

// Routes initialize
$path = realpath(__DIR__ . '/../resources/routes');
$routes = new DirectoryIterator($path);

foreach ($routes as $r) {
    if ($r->isFile())
        include $r->getPathname();
}

echo $router->dispatch()->response();
