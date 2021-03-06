<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/28/20
 * Time: 12:49 PM
 */

namespace App\Action\Auth;


use App\Auth\JwtAuth;
use App\Domain\User\Service\SuperUserAuth;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TokenCreateAction
{
    /**
     * @var JwtAuth
     */
    private $jwtAuth;

    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var SuperUserAuth
     */
    private $superUserAuth;

    public function __construct(
        JwtAuth $jwtAuth,
        Responder $responder,
        SuperUserAuth $superUserAuth
    )
    {
        $this->jwtAuth = $jwtAuth;
        $this->responder = $responder;
        $this->superUserAuth = $superUserAuth;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $data = (array)$request->getParsedBody();

        $username = (string)($data['username'] ?? '');
        $password = (string)($data['password'] ?? '');

        // Validate login
        $isValidLogin = $this->superUserAuth->authenticate($username, $password);

        if (!$isValidLogin) {
            // Invalid authentication credentials

            return $this->responder->json($response, ['message' => 'Invalid credentials'])
                ->withStatus(401, 'Unauthorized');
        }

        $token = $this->jwtAuth->createJwt([
            'uid' => $username,
        ]);

        $lifetime = $this->jwtAuth->getLifetime();

        // Transform the response into an Oauth 2.0 access token response
        $result = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $lifetime,
        ];

        return $this->responder->json($response, $result)->withStatus(201);
    }
}