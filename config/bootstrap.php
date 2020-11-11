<?php

declare(strict_types=1);

use Slim\App;
use Slim\Http\StatusCode;
use Symfony\Component\Dotenv\Dotenv;

setlocale(LC_TIME, 'es_ES.utf8');

require __DIR__ . '/../vendor/autoload.php';

set_error_handler(function ($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        return;
    }

    throw new ErrorException($message, StatusCode::HTTP_INTERNAL_SERVER_ERROR, $severity, $file, $line);
});

(new Dotenv(true))->loadEnv(dirname(__DIR__) . '/.env');

require_once __DIR__ . '/settings.php';

$app = new App($settings);

require_once __DIR__ . '/dependencies.php';
require_once __DIR__ . '/events.php';
require_once __DIR__ . '/middleware.php';
require_once __DIR__ . '/routes.php';

return $app;
