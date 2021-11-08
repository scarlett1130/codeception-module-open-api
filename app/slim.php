<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$pets = require __DIR__ . '/pets.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->get('/pets', function (Request $request, Response $response) use ($pets) {
    $query = $request->getQueryParams();
    $tags = $query['tags'] ?? [];
    $limit = isset($query['limit']) && is_numeric($query['limit']) ? (int)$query['limit']: null;

    if ($tags) {
        $pets = array_filter($pets, function ($pet) use ($tags) {
            return in_array($pet['tag'], $tags, true);
        });
    }

    if ($limit) {
        $pets = array_slice($pets, 0, $limit);
    }

    $response->getBody()->write(json_encode($pets));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/pets', function (Request $request, Response $response) use ($pets) {
    $pet = $request->getParsedBody();
    $newPet = array_merge(['id' => count($pets) + 1], $pet);

    $response->getBody()->write(json_encode($newPet));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/pets/{id}', function (Request $request, Response $response) use ($pets) {
    $id = (int)$request->getAttribute('id');
    $found = null;

    foreach ($pets as $pet) {
        if ($pet['id'] === $id) {
            $found = $pet;
            break;
        }
    }

    if ($found) {
        $response->getBody()->write(json_encode($found));
    } else {
        $error = [
            'code' => 404,
            'message' => 'pet not found',
        ];
        $response->getBody()->write(json_encode($error));
        $response = $response->withStatus(404);
    }

    return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/pets/{id}', function (Request $request, Response $response) {
    return $response
        ->withStatus(204)
        ->withHeader('Content-Type', 'application/json');
});

return $app;