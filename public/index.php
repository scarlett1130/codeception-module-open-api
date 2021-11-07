<?php

declare(strict_types=1);

use Slim\App;

/** @var App $app */
$app = require_once __DIR__ . '/../app/slim.php';
$app->run();
