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
use Slim\Views\Twig;
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
     * @var Twig
     */
    private $twig;

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
     * @param Twig $twig $twig The twig engine
     * @param UrlGenerator $urlGenerator $urlGenerator The url generator
     * @param ResponseFactoryInterface $responseFactory $responseFactory The response factory
     */
    public function __construct(Twig $twig, UrlGenerator $urlGenerator, ResponseFactoryInterface $responseFactory)
    {
        $this->twig = $twig;
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
     * Output rendered template
     *
     * @param ResponseInterface $response The response
     * @param string $template Template pathname relative to templates directory
     * @param array $data Associative array of template variables
     *
     * @return ResponseInterface The response
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        return $this->twig->render($response, $template, $data);
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
            $destination = $this-$this->urlGenerator->fullUrlFor($destination, $data, $queryParams);
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
     * @param $data<array> The data
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