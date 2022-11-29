<?php

use Application\Controller\Car\AllCarController;
use Application\Controller\Car\IndexCarController;
use Application\Controller\Common\AboutController;
use Application\Controller\Common\HomeController;
use Application\Controller\Post\IndexPostController;
use Application\Controller\Post\AllPostController;
use Application\Controller\Product\IndexProductController;
use Application\Controller\Product\AllProductController;
use Application\Controller\User\IndexUserController;
use Application\Controller\User\AllUserController;
use Framework\Http\Request\Request;
use Framework\Http\Response\Response;
use Framework\Routing\Exception\NotMatchedException;
use Framework\Routing\RouteCollection;
use Framework\Routing\Router\SimpleRouter;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

//********** Init **********
$request = new Request(array_merge($_SERVER, $_GET));

$routeCollection = new RouteCollection();

//common path
$routeCollection->get('home', '/', HomeController::class);
$routeCollection->get('about', '/about', AboutController::class);

//user path
$routeCollection->get('show_user', '/users', AllUserController::class);
$routeCollection->get('user', '/users/{id}', IndexUserController::class, ['id' => '\d+']);

//post path
$routeCollection->get('show_post', '/posts', AllPostController::class);
$routeCollection->get('post', '/posts/{id}', IndexPostController::class, ['id' => '\d+']);

//product path
$routeCollection->get('show_product', '/products', AllProductController::class);
$routeCollection->get('product', '/products/{id}', IndexProductController::class, ['id' => '\d+']);

//car path
$routeCollection->get('show_car', '/cars', AllCarController::class);
$routeCollection->get('car', '/cars/{id}', IndexCarController::class, ['id' => '\d+']);

//********** Run **********

$router = new SimpleRouter($routeCollection);

try {
    $result = $router->match($request);
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    $handler = $result->getHandler();
    $controller = is_string($handler) ? new $handler() : $handler;
    $response = $controller($request);
} catch (NotMatchedException $e) {
    $response = new Response('Not found Page!!!', 404);
}


print $response->getBody();


