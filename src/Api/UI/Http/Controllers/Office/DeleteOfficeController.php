<?php

declare(strict_types=1);

namespace Api\UI\Http\Controllers\Office;

use Api\Application\Commands\Office\Delete\DeleteOfficeCommand;
use Api\Domain\Shared\Param;
use Api\UI\Http\Controllers\AbstractController;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;
use Throwable;

final class DeleteOfficeController extends AbstractController
{
    /**
     * @OA\Delete(
     *     path="/v1/offices",
     *     tags={"Housfy Offices"},
     *     summary="Delete an office",
     *     description="Delete an office by its uuid",
     *     operationId="delete-office",
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
     *                 required={"uuid"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content",
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
     *         description="Internal Server Error."
     *     )
     * )
     *
     * @param Request $request
     * @param Response $response
     * @throws Throwable
     * @return Response
     */
    public function delete(Request $request, Response $response): Response
    {
        try {
            if (!$this->isRequestValid($request)) {
                return $response->withJson(
                    ['Invalid provided parameters. Please check them.'],
                    StatusCode::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $command = new DeleteOfficeCommand(
                $request->getParsedBodyParam(Param::UUID)
            );

            if (!$this->handler($command)) {
                return $response->withStatus(StatusCode::HTTP_NOT_FOUND);
            }

            return $response->withStatus(StatusCode::HTTP_NO_CONTENT);
        } catch (Exception $exception) {
            return $response->withJson($exception->getMessage(), $exception->getCode());
        }
    }
}
