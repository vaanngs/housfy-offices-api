<?php

declare(strict_types=1);

namespace Tests\Mock;

use Mockery as m;
use Psr\Http\Message\RequestInterface;
use RuntimeException;

class RequestFactory
{
    public static function make(string $method, array $params): RequestInterface
    {
        switch ($method) {
            case 'GET':
                return self::buildGet($params);
            case 'POST':
                return self::buildPost($params);
            default:
                throw new RuntimeException('Method not found');
        }
    }


    /**
     * @param array $params
     * @return RequestInterface
     */
    private static function buildGet(array $params): RequestInterface
    {
        $request = m::mock(RequestInterface::class);

        foreach ($params as $key => $param) {
            $request
                ->shouldReceive('getAttribute')
                ->with($key)
                ->andReturn($param);
        }

        return $request;
    }


    /**
     * @param array $params
     * @return RequestInterface
     */
    private static function buildPost(array $params): RequestInterface
    {
        $request = m::mock(RequestInterface::class);

        $request
            ->shouldReceive('getParsedBody')
            ->andReturn($params);

        return $request;
    }
}
