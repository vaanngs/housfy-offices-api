<?php

declare(strict_types=1);

use function OpenApi\scan;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

// Swagger
$app->get('/v1/docs', function (Request $request, Response $response, $args) {
    $dir     = __DIR__ . '/../src/Api/UI/Http/Controllers'; // Scan Controller folder
    $openapi = scan($dir);
    header('Content-type: application/x-yaml');

    return $openapi->toYaml();
});


$app->get('/', function (Request $request, Response $response) {
    return $response->withRedirect($this->router->pathFor('Status'));
});

$app->get('/status', function (Request $request, Response $response) {
    return $response->withStatus(StatusCode::HTTP_OK);
})->setName('Status');


$app->group('/v1/offices', function () use ($app) {
    $app->get('', 'GetAllOfficesController:get')->setName('get-all-offices');
    $app->post('', 'CreateOfficeController:create')->setName('create-office');
    $app->put('', 'UpdateOfficeController:update')->setName('update-office');
    $app->delete('', 'DeleteOfficeController:delete')->setName('delete-office');
});
