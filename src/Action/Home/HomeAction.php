<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/23/20
 * Time: 7:16 AM
 */

namespace App\Action\Home;

use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class HomeAction
 *
 * @package App\Action
 */
final class HomeAction
{
    /**
     * @var
     */
    private $responder;

    /**
     * HomeAction constructor.
     *
     * @param Responder $responder The responder
     */
    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $viewData = [
            'msg' => 'Welcome to Email Signature Generator REST API',
            'now' => date('d.m.Y H:i:s')
        ];

        return $this->responder->json($response, $viewData);
    }
}