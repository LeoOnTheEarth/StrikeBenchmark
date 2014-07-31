<?php

$n = 10000;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';

$bench = new Ubench();
$bench1 = new Ubench();
$bench2 = new Ubench();

$bench->start();

for ($i = 0; $i < $n; ++$i) {
    $router = Strike\RouterAccelerator::createRouter(
        new Strike\RouteFileLoader\IniRouteFileLoader(),
        array(__DIR__ . '/../cases/routes.ini'),
        array('cacheFile' => __DIR__ . '/../cache/ConsoleStrikeRoutes.php')
    );
    
    $result = $router->match('/blog/article/345/router-benchmarks');
}

$bench->end();

$bench1->start();

for ($i = 0; $i < $n; ++$i) {
    $router = Strike\RouterAccelerator::createRouter(
        new Strike\RouteFileLoader\IniRouteFileLoader(),
        array(__DIR__ . '/../cases/routes.ini'),
        array('cacheFile' => __DIR__ . '/../cache/ConsoleStrikeRoutes.php')
    );
}

$bench1->end();
$bench2->start();

for ($i = 0; $i < $n; ++$i) {
    $result = $router->match('/blog/article/345/router-benchmarks');
    //$result = $router->match('/');
}

$bench2->end();

showResults($n, $bench, $bench1, $bench2);
