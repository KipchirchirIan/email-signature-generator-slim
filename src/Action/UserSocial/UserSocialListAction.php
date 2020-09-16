<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 12:21 PM
 */

namespace App\Action\UserSocial;


use App\Domain\UserSocial\Service\UserSocialListDataTable;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserSocialListAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var UserSocialListDataTable
     */
    private $userSocialList;

    /**
     * UserSocialListAction constructor.
     *
     * @param Responder $responder The responder
     * @param UserSocialListDataTable $userSocialList The service
     */
    public function __construct(Responder $responder, UserSocialListDataTable $userSocialList)
    {
        $this->responder = $responder;
        $this->userSocialList = $userSocialList;
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
        $userId =  (int)$args['id'];

        return $this->responder->json($response, $this->userSocialList->listAllUserSocials($userId));
    }
}