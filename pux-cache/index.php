<?php

require __DIR__ . '/../vendor/autoload.php';

$cache = __DIR__ . '/../cache/PuxRoutes.php';

if (!file_exists($cache)) {
    $routes = parse_ini_file(__DIR__ . '/../cases/routes.ini', true);

    $router = new Pux\Mux();

    foreach ($routes as $id => $route) {
        $router->add($route['pattern2'], []);
    }

    $router->sort();

    $router->compile($cache);
} else {
    $router = require $cache;
}

$env = new Strike\Environment();

$route = $router->match($env->path);

echo ($route[0] ? $route[3]['pattern'] : $route[1]);
