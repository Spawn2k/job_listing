<?php

use Framework\Router;

require __DIR__ . '/../vendor/autoload.php';

require '../helper.php';



$router = new Router();

$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
