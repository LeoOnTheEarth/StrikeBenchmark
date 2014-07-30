<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = parse_ini_file(__DIR__ . '/routes.ini', true);

$collection = new RouteCollection();

foreach ($routes as $id => $route) {
    $collection->add($id, new Route($route['pattern']));
}

return $collection;
