<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/28/20
 * Time: 9:04 PM
 */

namespace App\Action\User;

use App\Domain\User\Data\UserCreatorData;
use App\Domain\User\Service\UserCreator;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UserCreateAction
 *
 * @package App\Action\User
 */
final class UserCreateAction
{
    /**
     * @var UserCreator
     */
    private $userCreator;

    /**
     * @var Responder
     */
    private $responder;

    /**
     * UserCreateAction constructor.
     *
     * @param Responder $responder The responder
     * @param UserCreator $userCreator The service
     */
    public function __construct(Responder $responder, UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
        $this->responder = $responder;
    }

    /**
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function  __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Collect input from HTTP request
        $data = (array)$request->getParsedBody();

        // Todo: Do mapping in mapper class
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

        // Invoke Domain with input and retain the results
        $userId = $this->userCreator->createUser($user);

        // Transform the result into JSON representation
        $result = [
            'user_id' => $userId
        ];

        // Build the HTTP response
        return $this->responder->json($response, $result);
    }
}