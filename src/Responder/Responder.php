<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/24/20
 * Time: 2:54 PM
 */

namespace App\Responder;

use App\Routing\UrlGenerator;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

/**
 * A generic responder
 *
 * Class Responder
 * @package App\Responder
 */
final class Responder
{
    /**
     * @var UrlGenerator
     */
    private $urlGenerator;

    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * Responder constructor.
     *
     * @param UrlGenerator $urlGenerator $urlGenerator The url generator
     * @param ResponseFactoryInterface $responseFactory $responseFactory The response factory
     */
    public function __construct(UrlGenerator $urlGenerator, ResponseFactoryInterface $responseFactory)
    {
        $this->urlGenerator = $urlGenerator;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Create a new response
     *
     * @return ResponseInterface The response
     */
    public function createResponse(): ResponseInterface
    {
        return $this->responseFactory->createResponse()->withHeader('Content-Type', 'text/html; charset=utf-8');
    }

    /**
     * Creates a redirect for the given url/ route name.
     *
     * This method prepares the response object to return an HTTP Redirect
     * response to the client.
     *
     * @param ResponseInterface $response The response
     * @param string $destination The redirect destination (url/route)
     * @param array<mixed> $data Named argument replacement data
     * @param array<mixed> $queryParams Optional query string parameters
     *
     * @return ResponseInterface The response
     */
    public function redirect(ResponseInterface $response, string $destination, array $data = [], array $queryParams = []): ResponseInterface
    {
        if (!filter_var($destination, FILTER_VALIDATE_URL)) {
            $destination = $this->urlGenerator->fullUrlFor($destination, $data, $queryParams);
        }

        return $response->withStatus(302)->withHeader('Location', $destination);
    }

    /**
     * Write JSON to the response body
     *
     * This method prepares the response object to return an HTTP JSON
     * response to the client.
     *
     * @param ResponseInterface $response The response
     * @param mixed $data data
     * @param int $options Json encoding options
     *
     * @throws NotEncodableValueException
     *
     * @return ResponseInterface The response
     */
    public function json(ResponseInterface $response, $data, int $options = 0): ResponseInterface
    {
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write((string)(new JsonEncode([JsonEncode::OPTIONS => $options]))->encode($data, 'json'));

        return $response;
    }

}