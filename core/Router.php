<?php

namespace Core;

class Router
{
    private array $routes;

    public function get(string $url, array $action)
    {
        $http_method = 'GET';
        $this->add($url, $http_method, $action);
    }

    public function post(string $url, array $action)
    {
        $http_method = 'POST';
        $this->add($url, $http_method, $action);
    }

    public function add(string $url, string $http_method, array $action)
    {
        $this->routes[] = compact('url', 'http_method', 'action');
    }

    public function route_to_controller(string $uri, string $http_method)
    {
        $f = array_filter($this->routes,
            fn($v, $k) => $uri === $v['url'] &&
                $http_method === $v['http_method'],
            ARRAY_FILTER_USE_BOTH
        );
        $route = (array_values($f)[0]);
        $controller = new $route['action'][0]();
        $controller->{$route['action'][1]}();
    }
}