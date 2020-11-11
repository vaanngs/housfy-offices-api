<?php

declare(strict_types=1);

namespace Api\UI\Http\Controllers\Office;

use Api\Application\Commands\Office\Update\UpdateOfficeCommand;
use Api\Domain\Shared\Param;
use Api\UI\Http\Controllers\AbstractController;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;
use Throwable;

final class UpdateOfficeController extends AbstractController
{

    /**
     * @OA\Put(
     *     path="/v1/offices",
     *     tags={"Housfy Offices"},
     *     summary="Update office",
     *     description="Update an existing office by its uuid",
     *     operationId="update-office",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="uuid",
     *                     type="string",
     *                     example="6e9ccde5-8ca8-4e1e-b9a7-4fde954fcbef"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="Housfy Gavà"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                       type="array",
     *                     @OA\Items(
     *                         type="object",
     *    	    		       @OA\Property(
     *                             property="postalcode",
     *                             type="string",
     *                             example="08850"
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
     *                     )
     *                 ),
     *                 required={"uuid"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad arguments"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     *
     * @param Request   $request
     * @param Response  $response
     * @return Response
     * @throws Throwable
     */
    public function update(Request $request, Response $response): Response
    {
        try {
            $this->isRequestValid($request);

            $command = new UpdateOfficeCommand(
                $request->getParsedBodyParam(Param::UUID),
                $request->getParsedBodyParam(Param::OFFICE_NAME),
                $request->getParsedBodyParam(Param::OFFICE_ADDRESS)[0]
            );

            $this->handler($command);

            return $response->withStatus(StatusCode::HTTP_OK);
        } catch (Exception $exception) {
            return $response->withStatus($exception->getCode(), $exception->getMessage());
        }
    }
}