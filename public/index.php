<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Application\Controller\AboutController;
use Application\Controller\CarController;
use Application\Controller\HomeController;
use Application\Controller\PostController;
use Application\Controller\ProductController;
use Application\Controller\UserController;
use Framework\Container;
use Framework\Http\HandlerTransformer;
use Framework\Http\Request\Request;
use Framework\Http\Response\Response;
use Framework\Http\Response\Serializer\JsonSerializer;
use Framework\Routing\Exception\NotMatchedException;
use Framework\Routing\RouteCollection;
use Framework\Routing\Router\SimpleRouter;

chdir(dirname(__DIR__));
define("PATH", getcwd());

require 'vendor/autoload.php';

$container = new Container();

///** @var EventDispatcher $eventDispatcher */
//$eventDispatcher = $container->get(EventDispatcher::class);

//********** Init **********
$request = new Request(array_merge($_SERVER, $_GET));

$routeCollection = new RouteCollection();

$jsonSerialize = $container->get(JsonSerializer::class);

//Common path
$routeCollection->get('home', '/', $container->get(HomeController::class));
$routeCollection->get('about', '/about', $container->get(AboutController::class));

//User path
$routeCollection->get('show_user', '/users', $container->get(UserController::class));
$routeCollection->get('user', '/users/{id}', [$container->get(UserController::class), 'showOne'], ['id' => '\d+']);

//Post path
$routeCollection->get('show_post', '/posts', $container->get(PostController::class));
$routeCollection->get('post', '/posts/{id}', [$container->get(PostController::class), 'showOne'], ['id' => '\d+']);

//Product path
$routeCollection->get('show_product', '/products', $container->get(ProductController::class));
$routeCollection->get('product', '/products/{id}', [$container->get(ProductController::class), 'showOne'], ['id' => '\d+']);

//Car path
$routeCollection->get('show_car', '/cars', $container->get(CarController::class));
$routeCollection->get('car', '/cars/{id}', [$container->get(CarController::class), 'showOne'], ['id' => '\d+']);

$router = new SimpleRouter($routeCollection);
$handlerTransformer = new HandlerTransformer();

try {
    $result = $router->match($request);
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    $handler = $result->getHandler();
    $handler = is_array($handler) ? $handlerTransformer->transform($handler, $request) : $handler;
    $controller = is_string($handler) ? new $handler() : $handler;
    $additionalArguments = [];
    if (is_array($controller)) {
        $additionalArguments = \array_slice($controller, 2)['arguments'];
        $controller = \array_slice($controller, 0, 2);
    }
    $response = $controller(...\array_merge([$request], $additionalArguments));
} catch (NotMatchedException $e) {
    $response = new Response('Not found Page!!!', 404);
}

print $response->getBody();
