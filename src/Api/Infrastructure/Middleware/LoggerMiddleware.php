<?php

declare(strict_types=1);

namespace Api\Infrastructure\Middleware;

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Slim\Exception\NotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

class LoggerMiddleware
{
    const REQUEST  = 'REQUEST';
    const RESPONSE = 'RESPONSE';

    private LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     * @throws NotFoundException
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        $route = $request->getAttribute('route');

        if (empty($route)) {
            throw new NotFoundException($request, $response);
        }

        if ('/' == $route->getPattern() || '/status' == $route->getPattern()) {
            return $next($request, $response);
        }

        $log = [
            'type'       => self::REQUEST,
            'method'     => $request->getMethod(),
            'uri'        => $route->getPattern(),
            'uri_params' => [
                array_merge(
                    $route->getArguments(),
                    $request->getParams()
                ),
            ],
        ];

        $this->logger->info(null, $log);

        /** @var Response $response */
        $response = $next($request, $response);

        $level = $this->getLevelByStatus($response->getStatusCode());

        $log = [
            'type'             => self::RESPONSE,
            'http_code'        => $response->getStatusCode(),
            'http_description' => $response->getReasonPhrase(),
            'response'         => json_decode($response->getBody(), true),
        ];
        $this->logger->$level(null, $log);

        return $response;
    }


    /**
     * @param int $code
     * @return string
     */
    public function getLevelByStatus(int $code): string
    {
        switch ($code) {
            case $code > 399 && $code < 500:
                $level = Logger::WARNING;

                break;
            case $code > 499:
                $level = Logger::ERROR;

                break;
            default:
                $level = Logger::INFO;
        }

        return strtolower(Logger::getLevelName($level));
    }
}
