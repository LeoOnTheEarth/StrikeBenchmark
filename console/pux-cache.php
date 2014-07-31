<?php

$n = 10000;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';

$routes = parse_ini_file(__DIR__ . '/../cases/routes.ini', true);

$cache = __DIR__ . '/../cache/ConsolePuxRoutes.php';

$bench1 = new Ubench();     // Total benchmark
$bench2 = new Ubench();     // Match pattern benchmark

$bench1->start();

for ($i = 0; $i < $n; ++$i) {
    if (!file_exists($cache)) {
        $router = new Pux\Mux();

        foreach ($routes as $id => $route) {
            $router->add($route['pattern2'], []);
        }

        $router->sort();

        $router->compile($cache);
    } else {
        $router = require $cache;
    }
    
    $route = $router->match('/blog/article/345/router-benchmarks');
}

$bench1->end();

$router = require $cache;

$bench2->start();

for ($i = 0; $i < $n; ++$i) {
    $route = $router->match('/blog/article/345/router-benchmarks');
    //$route = $router->match('/');
}

$bench2->end();

showResults($n, $bench1, $bench2);
