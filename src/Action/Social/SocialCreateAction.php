<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/19/20
 * Time: 3:14 AM
 */

namespace App\Action\Social;


use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Service\SocialCreator;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SocialCreateAction
{
    private $responder;

    private $socialCreator;

    public function __construct(SocialCreator $socialCreator, Responder $responder)
    {
        $this->responder = $responder;
        $this->socialCreator = $socialCreator;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Collect input from the HTTP request
        $socialData = new SocialCreatorData((array)$request->getParsedBody());

        // Invoke the domain with inputs and retain the results
        $socialId = $this->socialCreator->createSocial($socialData);

        $viewData = [
            $socialId => $socialData
        ];

        // Build the HTTP response
        return $this->responder->json($response, $viewData);
    }
}