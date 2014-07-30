<?php

// Reference: http://symfony.com/doc/current/components/routing/introduction.html

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

$routes = parse_ini_file(__DIR__ . '/../cases/routes.ini', true);

$collection = new RouteCollection();

foreach ($routes as $id => $route) {
    $collection->add($id, new Route($route['pattern']));
}

$context = new RequestContext($_SERVER['REQUEST_URI']);
$matcher = new UrlMatcher($collection, $context);

$parameters = $matcher->matchRequest(Request::createFromGlobals());

$route = $collection->get($parameters['_route']);

echo $route->getPath();
