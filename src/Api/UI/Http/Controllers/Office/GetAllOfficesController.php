<?php

declare(strict_types=1);

namespace Api\UI\Http\Controllers\Office;

use Api\Application\Commands\Office\FindAll\FindAllOfficesCommand;
use Api\UI\Http\Controllers\AbstractController;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

final class GetAllOfficesController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/v1/offices",
     *     tags={"Housfy Offices"},
     *     summary="Get offices",
     *     description="Get all Housfy's offices",
     *     operationId="get-all-offices",
     *     @OA\Response(
     *         response=200,
     *         description="Get resource",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     *
     * @param Request  $request
     * @param Response $response
     * @return Response
     */
    public function get(Request $request, Response $response): Response
    {
        try {
            $offices = $this->handler(new FindAllOfficesCommand());

            return $response->withJson($offices, StatusCode::HTTP_OK);
        } catch (\Exception $exception) {
            return $response->withStatus($exception->getCode(), $exception->getMessage());
        }
    }
}
