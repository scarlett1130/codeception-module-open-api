<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->get('/', function (Request $request, Response $response) {
    $data    = ['name' => 'Bob', 'age' => 40];
    $payload = json_encode($data);

    $response->getBody()->write($payload);

    return $response
        ->withHeader('Content-Type', 'application/json');
});

return $app;