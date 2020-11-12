<?php

declare(strict_types=1);

namespace Api\UI\Http\Controllers\Office;

use Api\Application\Commands\Office\Create\CreateOfficeCommand;
use Api\Domain\Shared\Param;
use Api\UI\Http\Controllers\AbstractController;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;
use Throwable;

final class CreateOfficeController extends AbstractController
{

    /**
     * @OA\Post(
     *     path="/v1/offices",
     *     tags={"Housfy Offices"},
     *     summary="Create office",
     *     description="Create a Housfy's office",
     *     operationId="create-office",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="Housfy Viladecans"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                       type="array",
     *                     @OA\Items(
     *                         type="object",
     *    	    		       @OA\Property(
     *                             property="postalcode",
     *                             type="string",
     *                             example="08840"
     *                         ),
     *                         @OA\Property(
     *                             property="province",
     *                             type="string",
     *                             example="Barcelona"
     *                         ),
     *                         @OA\Property(
     *                             property="city",
     *                             type="string",
     *                             example="Gavà"
     *                         ),
     *                         @OA\Property(
     *                             property="address_line",
     *                             type="string",
     *                             example="Carretera de la Vila, 90"
     *                         ),
     *                         required={"postalcode", "province", "city", "address_line"}
     *                     )
     *                 ),
     *                 required={"name", "address"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Create resource",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad arguments"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     *
     * @param Request   $request
     * @param Response  $response
     * @return Response
     * @throws Throwable
     */
    public function create(Request $request, Response $response): Response
    {
        try {
            if (!$this->isRequestValid($request)) {
                return $response->withJson(
                    ['Invalid provided parameters. Please check them.'],
                    StatusCode::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $params  = $request->getParsedBody();
            $address = $params[Param::OFFICE_ADDRESS];

            $command = new CreateOfficeCommand(
                $params[Param::OFFICE_NAME],
                $address[0]
            );

            $office = $this->handler($command);

            return $response->withJson($office, StatusCode::HTTP_CREATED);
            
        } catch (\Exception $exception) {
            return $response->withStatus($exception->getCode(), $exception->getMessage());
        }
    }
}