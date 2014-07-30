<?php

$n = 10000;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';

use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Config\FileLocator;

$bench = new Ubench();
$bench1 = new Ubench();
$bench2 = new Ubench();

$bench->start();
$bench1->start();

for ($i = 0; $i < $n; ++$i) {
    $locator = new FileLocator(array(__DIR__ . '/../cases'));

    $router = new Router(
        new PhpFileLoader($locator),
        'symfony-routes.php',
        array(
            'cache_dir' => __DIR__ . '/../cache',
            'matcher_cache_class' => 'ConsoleProjectUrlMatcher',
        )
    );

    $router->getRouteCollection();
}

$bench1->end();
$bench2->start();

for ($i = 0; $i < $n; ++$i) {
    $parameters = $router->match('/blog/article/345/router-benchmarks');
    //$parameters = $router->match('/');

    $route = $router->getRouteCollection()->get($parameters['_route']);

    //echo $route->getPath();
}

$bench2->end();
$bench->end();

showResults($n, $bench, $bench1, $bench2);
