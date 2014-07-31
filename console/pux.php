<?php

$n = 10000;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';

$routes = parse_ini_file(__DIR__ . '/../cases/routes.ini', true);

$bench = new Ubench();
$bench1 = new Ubench();
$bench2 = new Ubench();

$bench->start();

for ($i = 0; $i < $n; ++$i) {
    $router = new Pux\Mux();

    foreach ($routes as $id => $route) {
        $router->add($route['pattern2'], ['Controller', 'action']);
    }

    $router->sort();
    
    $route = $router->match('/blog/article/345/router-benchmarks');
}

$bench->end();

$bench1->start();

for ($i = 0; $i < $n; ++$i) {
    $router = new Pux\Mux();

    foreach ($routes as $id => $route) {
        $router->add($route['pattern2'], ['Controller', 'action']);
    }

    $router->sort();
}

$bench1->end();
$bench2->start();

for ($i = 0; $i < $n; ++$i) {
    $route = $router->match('/blog/article/345/router-benchmarks');
    //$route = $router->match('/');
}

$bench2->end();

showResults($n, $bench, $bench1, $bench2);
