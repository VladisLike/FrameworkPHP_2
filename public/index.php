<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
use Application\Model\Car;
use Application\Repository\CarRepository;
use Application\Repository\ProductRepository;
use Application\Subscriber\CarSubscriber;
use Framework\Container;
use Framework\EventDispatcher\EventDispatcher;
use Framework\Http\HandlerTransformer;
use Framework\Http\Request\Request;
use Framework\Http\Response\Response;
use Framework\Http\Response\Serializer\JsonSerializer;
use Framework\Repository\DataResource\DataFilePHP;
use Framework\Routing\Exception\NotMatchedException;
use Framework\Routing\RouteCollection;
use Framework\Routing\Router\SimpleRouter;

chdir(dirname(__DIR__));
define("PATH", getcwd());

require 'vendor/autoload.php';

$container = new Container();

/** @var EventDispatcher $eventDispatcher */
$eventDispatcher = $container->get(EventDispatcher::class);

//********** Init **********
$request = new Request(array_merge($_SERVER, $_GET));

$routeCollection = new RouteCollection();

$jsonSerialize = $container->get(JsonSerializer::class);

//Common path
$routeCollection->get('home', '/', HomeController::class);
$routeCollection->get('about', '/about', AboutController::class);

//User path
$routeCollection->get('show_user', '/users', new AllUserController($jsonSerialize));
$routeCollection->get('user', '/users/{id}', IndexUserController::class, ['id' => '\d+']);

//Post path
$routeCollection->get('show_post', '/posts', new AllPostController($jsonSerialize));
$routeCollection->get('post', '/posts/{id}', [new AllPostController($jsonSerialize), 'showOne'], ['id' => '\d+']);

//Product path
$routeCollection->get('show_product', '/products', $container->get(AllProductController::class));
$routeCollection->get('product', '/products/{id}', IndexProductController::class, ['id' => '\d+']);

//Car path
$routeCollection->get('show_car', '/cars', $container->get(AllCarController::class));
//$routeCollection->get('car', '/cars/{id}', IndexCarController::class, ['id' => '\d+']);
$routeCollection->get('car', '/cars/{id}', [$container->get(AllCarController::class), 'showOne'], ['id' => '\d+']);

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
