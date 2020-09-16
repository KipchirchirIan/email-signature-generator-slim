<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/19/20
 * Time: 11:39 PM
 */

namespace App\Action\Social;


use App\Domain\Social\Service\SocialViewer;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SocialViewAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var SocialViewer
     */
    private $socialViewer;

    /**
     * SocialViewAction constructor.
     *
     * @param Responder $responder The responder
     *
     * @param SocialViewer $socialViewer The service
     */
    public function __construct(Responder $responder, SocialViewer $socialViewer)
    {
        $this->responder = $responder;
        $this->socialViewer = $socialViewer;
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
        // Fetch parameters from the request
        $socialId = (int)$args['id'];

        // Invoke the domain(service class)
        $social = $this->socialViewer->getSocialViewData($socialId);

        // Build the HTTP response
        return $this->responder->json($response, $social);
    }
}