<?php

const BASE_PATH = __DIR__ . '/..';
require BASE_PATH . '/core/helpers/functions.php';

require base_path('vendor/autoload.php');

$router = new \Core\Router();

require base_path('routes/web.php');

$http_method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route_to_controller($uri, $http_method);

//<!--var_dump($jiris);-->
//<!--print_r($jiris);-->
//<!--array()-->
