<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;

$locator = new FileLocator(array(__DIR__ . '/../cases'));
$requestContext = new RequestContext($_SERVER['REQUEST_URI']);

$router = new Router(
    new PhpFileLoader($locator),
    'symfony-routes.php',
    array('cache_dir' => __DIR__ . '/../cache'),
    $requestContext
);

$parameters = $router->matchRequest(Request::createFromGlobals());

$route = $router->getRouteCollection()->get($parameters['_route']);

echo $route->getPath();
