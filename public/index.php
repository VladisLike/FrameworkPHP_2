<?php

use Framework\Http\JsonResponse;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routing\RouteCollection;
use Framework\Routing\Router\Router;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$routeCollection = new RouteCollection();

$routeCollection->get('home', '/', function (Request $request) {
    $name = $request->getParams()['name'] ?? 'Guest';
    return new Response("<h1>Home Page ($name)<h1/>");
});

$routeCollection->get('about', '/about', function () {
    return new Response("<h1>About Page<h1/>");
});

$routeCollection->get('show_car', '/cars', function () {
    return new JsonResponse([
        ['id' => 1, 'model' => 'X3',],
        ['id' => 2, 'model' => 'X5',],
    ]);
});

$router = new Router($routeCollection);

$request = new Request(array_merge($_SERVER, $_GET, $_POST));

$result = $router->match($request);
$handler = $result->getHandler();
if ($handler) {
    $response = $handler($request);
} else {
    $response = new Response('Not found Page!!!');
}

print $response->getBody();

