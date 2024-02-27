<?php

function dd(...$vars)
{
    echo "<pre>";
    foreach ($vars as $var) {
        var_dump($var);
    }
    echo "</pre>";
    die();
}

function view(string $view, array $data)
{
    extract($data);
    $parts = explode('.', $view);
    $resource = $parts[0];
    $action = $parts[1];
    require BASE_PATH . "/resources/views/{$resource}/{$action}.view.php";
}

function base_path(string $path = ''): string
{
    //TODO handle wrong path arguement
    return BASE_PATH . '/' . $path;
}

function app_path(string $path): string
{
    return base_path('app');
}

function resource_path(string $ressource): string
{
    return base_path('resources');
}