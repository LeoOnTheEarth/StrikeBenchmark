<?php

require __DIR__ . '/../vendor/autoload.php';

$router = Strike\RouterAccelerator::createRouter(
    new Strike\RouteFileLoader\IniRouteFileLoader(),
    array(__DIR__ . '/../cases/routes.ini'),
    array('cacheFile' => __DIR__ . '/../cache/StrikeRoutes.php')
);

$result = $router->matchRequest(new Strike\Environment());

echo $result['pattern'];
