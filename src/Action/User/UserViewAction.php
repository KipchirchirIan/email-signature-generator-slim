<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/30/20
 * Time: 4:58 PM
 */

namespace App\Action\User;


use App\Domain\User\Service\UserViewer;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserViewAction
{
    /**
     * @var UserViewer
     */
    private $userReader;

    /**
     * @var Responder
     */
    private $responder;

    /**
     * UserViewAction constructor.
     *
     * @param Responder $responder The responder
     * @param UserViewer $userViewer The service
     */
    public function __construct(Responder $responder, UserViewer $userViewer)
    {
        $this->responder = $responder;
        $this->userReader = $userViewer;
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
        // Fetch parameters from request
        $userId = (int)$args['id'];

        // Invoke the domain(service class)
        $user = $this->userReader->getUserViewData($userId);

        // Prepare the view data
        $viewData = [
            'user' => $user
        ];

        return $this->responder->json($response, $viewData);
    }
}