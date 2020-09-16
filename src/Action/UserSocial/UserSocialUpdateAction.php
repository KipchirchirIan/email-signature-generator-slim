<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/22/20
 * Time: 6:22 AM
 */

namespace App\Action\UserSocial;


use App\Domain\UserSocial\Data\UserSocialUpdaterData;
use App\Domain\UserSocial\Service\UserSocialUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserSocialUpdateAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var UserSocialUpdater
     */
    private $userSocialUpdater;

    /**
     * UserSocialUpdateAction constructor.
     *
     * @param Responder $responder The responder
     * @param UserSocialUpdater $userSocialUpdater The service
     */
    public function __construct(Responder $responder, UserSocialUpdater $userSocialUpdater)
    {
        $this->responder = $responder;
        $this->userSocialUpdater = $userSocialUpdater;
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
    public function  __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $userId = (int)$args['id'];
        $userSocialData = new UserSocialUpdaterData((array)$request->getParsedBody());

        // Invoke the domain with input/args and retain results
        $result = $this->userSocialUpdater->editUserSocial($userSocialData, $userId);

        $viewData = [
            'message' => $result,
            'body' => $userSocialData
        ];

        return $this->responder->json($response, $viewData);
    }
}