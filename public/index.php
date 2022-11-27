<?php

use Application\Controller\Car\ShowCarController;
use Application\Controller\Common\AboutController;
use Application\Controller\Common\HomeController;
use Application\Controller\Post\ShowPostController;
use Application\Controller\Product\ShowProductController;
use Application\Controller\User\ShowUserController;
use Framework\Http\Request\Request;
use Framework\Http\Response\Response;
use Framework\Routing\RouteCollection;
use Framework\Routing\Router\SimpleRouter;

chdir(dirname(__DIR__));
define("PATH", \getcwd());

require 'vendor/autoload.php';

//********** Init **********
$request = new Request(array_merge($_SERVER, $_GET, $_POST));

$routeCollection = new RouteCollection();

$routeCollection->get('home', '/', HomeController::class);
$routeCollection->get('about', '/about', AboutController::class);

$routeCollection->get('show_user', '/users', ShowUserController::class);
$routeCollection->get('show_post', '/posts', ShowPostController::class);
$routeCollection->get('show_product', '/products', ShowProductController::class);
$routeCollection->get('show_car', '/cars', ShowCarController::class);

//********** Run **********

$router = new SimpleRouter($routeCollection);

$result = $router->match($request);
$handler = $result->getHandler();
if ($handler) {
    $controller = is_string($handler) ? new $handler() : $handler;
    $response = $controller($request);
} else {
    $response = new Response('Not found Page!!!');
}

print $response->getBody();
