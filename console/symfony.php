<?php

$n = 10000;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = parse_ini_file(__DIR__ . '/../cases/routes.ini', true);

$bench = new Ubench();
$bench1 = new Ubench();
$bench2 = new Ubench();

$bench->start();

for ($i = 0; $i < $n; ++$i) {
    $collection = new RouteCollection();

    foreach ($routes as $id => $route) {
        $collection->add($id, new Route($route['pattern']));
    }

    $context = new RequestContext();
    $matcher = new UrlMatcher($collection, $context);
    
    $parameters = $matcher->match('/blog/article/345/router-benchmarks');
    //$parameters = $router->match('/');
    $route = $collection->get($parameters['_route']);
}

$bench->end();

$bench1->start();

for ($i = 0; $i < $n; ++$i) {
    $collection = new RouteCollection();

    foreach ($routes as $id => $route) {
        $collection->add($id, new Route($route['pattern']));
    }

    $context = new RequestContext();
    $matcher = new UrlMatcher($collection, $context);
}

$bench1->end();
$bench2->start();

for ($i = 0; $i < $n; ++$i) {
    $parameters = $matcher->match('/blog/article/345/router-benchmarks');
    //$parameters = $router->match('/');
    $route = $collection->get($parameters['_route']);
}

$bench2->end();

showResults($n, $bench, $bench1, $bench2);
