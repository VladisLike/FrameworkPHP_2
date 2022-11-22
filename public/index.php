<?php

use Framework\Http\Request;
use Framework\Http\Response;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$request = new Request(array_merge($_SERVER, $_GET, $_POST));

$path = $request->getUriPath();
$handler = null;

if ($path === '/' || $path === '/home') {
    $handler = function (Request $request) {
        $name = $request->getParams()['name'] ?? 'Guest';
        return new Response("<h1>Home Page ($name)<h1/>");
    };

} elseif ($path === '/about') {
    $handler = function () {
        return new Response("<h1>About Page<h1/>");
    };
} elseif ($path === '/cars') {
    $handler = function () {
        return new Response("<h1>Show all car:<h1/>");
    };
}

if ($handler) {
    $response = $handler($request);
} else {
    $response = new Response('Not found Page!!!');
}

echo $response->getBody();



