<?php

$n = 10000;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';

$routes = parse_ini_file(__DIR__ . '/../cases/routes.ini', true);

$bench1 = new Ubench();     // Total benchmark
$bench2 = new Ubench();     // Match pattern benchmark

$bench1->start();

for ($i = 0; $i < $n; ++$i) {
    $router = new Strike\Router();

    foreach ($routes as $id => $route) {
        $router->add($route['pattern'], array(
            'id' => $id,
        ));
    }
    
    $result = $router->match('/blog/article/345/router-benchmarks');
}

$bench1->end();

$router = new Strike\Router();

foreach ($routes as $id => $route) {
    $router->add($route['pattern'], array(
        'id' => $id,
    ));
}

$bench2->start();

for ($i = 0; $i < $n; ++$i) {
    $result = $router->match('/blog/article/345/router-benchmarks');
    //$result = $router->match('/');
}

$bench2->end();

showResults($n, $bench1, $bench2);
