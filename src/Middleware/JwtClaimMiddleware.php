<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/28/20
 * Time: 1:57 PM
 */

namespace App\Middleware;


use App\Auth\JwtAuth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * JWT Claim Middleware
 *
 * @package App\Middleware
 */
final class JwtClaimMiddleware implements MiddlewareInterface
{
    /**
     * @var JwtAuth
     */
    private $jwtAuth;

    /**
     * JwtClaimMiddleware constructor.
     *
     * @param JwtAuth $jwtAuth
     */
    public function __construct(JwtAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface
    {
        $authorization = explode(' ', (string)$request->getHeaderLine('Authorization'));
        $type = $authorization[0] ?? '';
        $credentials = $authorization[1] ?? '';

        if ($type === 'Bearer' && $this->jwtAuth->validateToken($credentials)) {
            // Append valid token
            $parsedToken = $this->jwtAuth->createParsedToken($credentials);
            $request = $request->withAttribute('token', $parsedToken);

            // Append the user id as request attribute
            $request = $request->withAttribute('uid', $parsedToken->getClaim('uid'));
        }

        return $handler->handle($request);
    }
}