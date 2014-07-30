<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;

$locator = new FileLocator(array(__DIR__ . '/../cases'));

$router = new Router(
    new PhpFileLoader($locator),
    'symfony-routes.php',
    array(
        'cache_dir' => __DIR__ . '/../cache',
        'matcher_cache_class' => 'ProjectUrlMatcher',
    )
);

$parameters = $router->matchRequest(Request::createFromGlobals());

$route = $router->getRouteCollection()->get($parameters['_route']);

echo $route->getPath();
