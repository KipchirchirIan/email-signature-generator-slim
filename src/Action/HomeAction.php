<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/23/20
 * Time: 7:16 AM
 */

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


final class HomeAction
{
    public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write('Welcome to Email Signature Generator REST API');
        return $response;
    }
}