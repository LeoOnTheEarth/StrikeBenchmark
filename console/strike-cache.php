<?php

$n = 10000;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';

$bench1 = new Ubench();     // Total benchmark
$bench2 = new Ubench();     // Match pattern benchmark

$bench1->start();

for ($i = 0; $i < $n; ++$i) {
    $router = Strike\RouterAccelerator::createRouter(
        new Strike\RouteFileLoader\IniRouteFileLoader(),
        array(__DIR__ . '/../cases/routes.ini'),
        array('cacheFile' => __DIR__ . '/../cache/ConsoleStrikeRoutes.php')
    );
    
    $result = $router->match('/blog/article/345/router-benchmarks');
}

$bench1->end();

$router = Strike\RouterAccelerator::createRouter(
    new Strike\RouteFileLoader\IniRouteFileLoader(),
    array(__DIR__ . '/../cases/routes.ini'),
    array('cacheFile' => __DIR__ . '/../cache/ConsoleStrikeRoutes.php')
);

$bench2->start();

for ($i = 0; $i < $n; ++$i) {
    $result = $router->match('/blog/article/345/router-benchmarks');
    //$result = $router->match('/');
}

$bench2->end();

showResults($n, $bench1, $bench2);
