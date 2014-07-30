<?php

require __DIR__ . '/../vendor/autoload.php';

$routes = parse_ini_file(__DIR__ . '/../cases/routes.ini', true);

$router = new Strike\Router();

foreach ($routes as $id => $route) {
    $router->add($route['pattern'], array(
        'id' => $id,
    ));
}

$result = $router->matchRequest(new Strike\Environment());

echo $result['pattern'];
