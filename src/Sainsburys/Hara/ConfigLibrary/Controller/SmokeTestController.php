<?php
namespace Sainsburys\Hara\ConfigLibrary\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SmokeTestController
{
    public function smokeTestAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $responseArray = [
            'result' => 'PASS',
            'details' => [
                null
            ]
        ];

        $response->getBody()->write(json_encode($responseArray));
        return $response;
    }
}
