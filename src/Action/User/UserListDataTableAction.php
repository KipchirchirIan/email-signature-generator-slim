<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/29/20
 * Time: 1:37 PM
 */

namespace App\Action\User;

use App\Responder\Responder;
use App\Domain\User\Service\UserListDataTable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserListDataTableAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var UserListDataTable
     */
    private $userListDataTable;

    /**
     * UserListDataTableAction constructor.
     *
     * @param Responder $responder The response
     * @param UserListDataTable $userListDataTable The service
     */
    public function __construct(Responder $responder, UserListDataTable $userListDataTable)
    {
        $this->responder = $responder;
        $this->userListDataTable = $userListDataTable;
    }

    /**
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->responder->json($response, $this->userListDataTable->listAllUsers());
    }
}