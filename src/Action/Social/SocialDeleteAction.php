<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 12:36 AM
 */

namespace App\Action\Social;


use App\Domain\Social\Service\SocialDelete;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SocialDeleteAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var SocialDelete
     */
    private $socialDelete;

    /**
     * SocialDeleteAction constructor.
     *
     * @param Responder $responder The responder
     * @param SocialDelete $socialDelete The service
     */
    public function __construct(Responder $responder, SocialDelete $socialDelete)
    {
        $this->responder= $responder;
        $this->socialDelete = $socialDelete;
    }

    /**
     * Action
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The routing arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $socialId = (int)$args['id'];

        return $this->responder->json($response, ['message' => $this->socialDelete->removeSocialById($socialId)]);
    }
}