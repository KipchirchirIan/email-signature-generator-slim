<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 3:17 AM
 */

namespace App\Action\UserSocial;


use App\Domain\UserSocial\Data\UserSocialCreatorData;
use App\Domain\UserSocial\Service\UserSocialCreator;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserSocialCreateAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var UserSocialCreator
     */
    private $userSocialCreator;

    /**
     * UserSocialCreateAction constructor.
     *
     * @param Responder $responder The responder
     * @param UserSocialCreator $userSocialCreator The service
     */
    public function __construct(Responder $responder, UserSocialCreator $userSocialCreator)
    {
        $this->responder = $responder;
        $this->userSocialCreator = $userSocialCreator;
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
        $userId = (int)$args['id'];

        $userSocial = new UserSocialCreatorData((array)$request->getParsedBody());

        $userSocial->userId = $userId;

        $userSocialId = $this->userSocialCreator->createUserSocial($userSocial, $userId);

        $viewData = [
            $userSocialId => $userSocial
        ];

        return $this->responder->json($response, $viewData);
    }
}