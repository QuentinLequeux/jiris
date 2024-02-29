<?php

use App\Http\Controllers\JiriController;

/** @var Core\Router $router */
$router->get('/', [JiriController::class, 'index']);
$router->get('/jiri', [JiriController::class, 'index']);
$router->get('/jiris', [JiriController::class, 'index']);
$router->get('/jiri/create', [JiriController::class, 'create']);
$router->post('/jiri', [JiriController::class, 'store']);