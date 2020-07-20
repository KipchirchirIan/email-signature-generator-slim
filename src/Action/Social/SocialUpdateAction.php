<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/20/20
 * Time: 4:06 AM
 */

namespace App\Action\Social;


use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Service\SocialUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SocialUpdateAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var SocialUpdater
     */
    private $socialUpdater;

    /**
     * SocialUpdateAction constructor.
     *
     * @param SocialUpdater $socialUpdater The service
     * @param Responder $responder The responder
     */
    public function __construct(SocialUpdater $socialUpdater, Responder $responder)
    {
        $this->responder = $responder;
        $this->socialUpdater = $socialUpdater;
    }

    /**
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The routing arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $socialId = (int)$args['id'];
        $socialData = new SocialCreatorData((array)$request->getParsedBody());

        // Invoke the domain with input/args and retain results
        $result = $this->socialUpdater->editSocial($socialData, $socialId);

       $viewData = [
           'message' => $result,
           'body' => $socialData
       ];

        return $this->responder->json($response, $viewData);
    }
}