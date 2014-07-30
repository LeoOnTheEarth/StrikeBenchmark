<?php

$n = 10000;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';

$routes = parse_ini_file(__DIR__ . '/../cases/routes.ini', true);

$bench = new Ubench();
$bench1 = new Ubench();
$bench2 = new Ubench();

$bench->start();
$bench1->start();

for ($i = 0; $i < $n; ++$i) {
    $router = new Pux\Mux();

    foreach ($routes as $id => $route) {
        $router->add($route['pattern2'], []);
    }

    $router->sort();
}

$bench1->end();
$bench2->start();

for ($i = 0; $i < $n; ++$i) {
    $route = $router->match('/blog/article/345/router-benchmarks');
    //$route = $router->match('/');

    //echo ($route[0] ? $route[3]['pattern'] : $route[1]) . PHP_EOL;
}

$bench2->end();
$bench->end();

showResults($n, $bench, $bench1, $bench2);
