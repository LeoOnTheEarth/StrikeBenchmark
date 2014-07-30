<?php

require __DIR__ . '/../vendor/autoload.php';

$routes = parse_ini_file(__DIR__ . '/../cases/routes.ini', true);

$router = new Pux\Mux();

foreach ($routes as $id => $route) {
    $router->add($route['pattern2'], []);
}

$router->sort();

$env = new Strike\Environment();

$route = $router->match($env->path);

echo ($route[0] ? $route[3]['pattern'] : $route[1]);
