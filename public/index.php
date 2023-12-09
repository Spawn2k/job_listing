<?php

use Framework\Router;
use Framework\Session;

require __DIR__ . '/../vendor/autoload.php';
require '../helper.php';

Session::start();

$router = new Router();

$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$router->route($uri);
