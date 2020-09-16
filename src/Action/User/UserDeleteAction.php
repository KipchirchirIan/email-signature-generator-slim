<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/7/20
 * Time: 8:55 AM
 */

namespace App\Action\User;


use App\Domain\User\Service\UserDelete;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UserDeleteAction
 * @package App\Action\User
 */
final class UserDeleteAction
{
    /**
     * @var Responder
     *
     */
    private $responder;
    /**
     * @var UserDelete
     */
    private $userDelete;

    /**
     * UserDeleteAction constructor.
     *
     * @param UserDelete $userDelete The service
     * @param Responder $responder The responder
     */
    public function __construct(UserDelete $userDelete, Responder $responder)
    {
        $this->responder = $responder;
        $this->userDelete = $userDelete;
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
        // Fetch parameters from the URL
        $userId = (int)$args['id'];

        // Invoke the domain(service class)
        $result = $this->userDelete->deleteUserData($userId);

        $viewData = [
            'result' => $result
        ];

        return $this->responder->json($response, $viewData);
    }
}