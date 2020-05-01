<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/30/20
 * Time: 12:01 PM
 */

namespace App\Action\User;

use App\Domain\User\Data\UserCreatorData;
use App\Domain\User\Service\UserCreator;
use App\Responder\Responder;
use App\Domain\User\Service\UserUpdater;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserUpdateAction
{
    private $responder;

    private $userUpdater;

    public function __construct(Responder $responder, UserUpdater $userUpdater)
    {
        $this->responder = $responder;
        $this->userUpdater = $userUpdater;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = (array)$request->getParsedBody();
        $id = (int)$args['id'];

        $user = new UserCreatorData();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->company = $data['company'];
        $user->department = $data['department'];
        $user->position = $data['position'];
        $user->phone = $data['phone'];
        $user->mobile = $data['mobile'];
        $user->website = $data['website'];
        $user->skype = $data['skype'];
        $user->address = $data['address'];

        // Invoke the domain with input/args and retain the results
        $res = $this->userUpdater->editUser($user, $id);

        $result = [
            'message' => $res
        ];

        // Build the HTTP response
        return $this->responder->json($response, $result);
    }
}