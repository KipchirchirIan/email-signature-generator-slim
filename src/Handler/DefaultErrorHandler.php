<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/27/20
 * Time: 10:27 AM
 */

namespace App\Handler;

use App\Factory\LoggerFactory;
use App\Responder\Responder;
use App\Utility\ExceptionDetail;
use DomainException;
use http\Exception\InvalidArgumentException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Selective\Validation\Exception\ValidationException;
use Slim\Exception\HttpException;
use Throwable;

/**
 * Default Error Renderer
 */
class DefaultErrorHandler
{

    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    private $responder;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param ResponseFactoryInterface $responseFactory The response factory
     * @param LoggerFactory $logger The logger
     */
    public function __construct(
        ResponseFactoryInterface $responseFactory,
        Responder $responder,
        LoggerFactory $logger
    ) {
        $this->responseFactory = $responseFactory;
        $this->responder = $responder;
        $this->logger = $logger->addFileHandler('error.log')
            ->createInstance('error');
    }

    /**
     * Invoke.
     *
     * @param ServerRequestInterface $request The request
     * @param Throwable $exception The exception
     * @param bool $displayErrorDetails Show error details
     * @param bool $logErrors Log errors
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors
    ): ResponseInterface {
         // Log error
        if ($logErrors) {
            $this->logger->error(sprintf(
                'Error: [%s] %s, Method: %s, Path: %s',
                $exception->getCode(),
                ExceptionDetail::getExceptionText($exception),
                $request->getMethod(),
                $request->getUri()->getPath()
            ));
        }

        // Detect status code
        $statusCode = $this->getHttpStatusCode($exception);

        // Error message
//        $errorMessage = [
//            'message' => $this->getErrorMessage($exception, $statusCode, $displayErrorDetails)
//        ];

        $errorMessage = $this->getErrorMessage($exception, $statusCode, $displayErrorDetails);

        // Create JSON response
        $response = $this->responseFactory->createResponse();

//        return $response->withStatus($statusCode);
        return $this->responder->json($response, $errorMessage)->withStatus($statusCode);
    }

    /**
     * Get http status code.
     *
     * @param Throwable $exception The exception
     *
     * @return int The http code
     */
    private function getHttpStatusCode(Throwable $exception): int
    {
        // Detect status code
        $statusCode = 500;

        if ($exception instanceof HttpException) {
            $statusCode = (int)$exception->getCode();
        }

        if ($exception instanceof DomainException || $exception instanceof InvalidArgumentException) {
            // Bad request
            $statusCode = 400;
        }

        if ($exception instanceof ValidationException) {
            // Unprocessable Entity
            $statusCode = 422;
        }

        $file = basename($exception->getFile());
        if ($file === 'CallableResolver.php') {
            $statusCode = 404;
        }

        return $statusCode;
    }

    /**
     * Get error message.
     *
     * @param Throwable $exception The error
     * @param int $statusCode The http status code
     * @param bool $displayErrorDetails Display details
     *
     * @return string The message
     */
    private function getErrorMessage(Throwable $exception, int $statusCode, bool $displayErrorDetails): array
    {
        $reasonPhrase = $this->responseFactory->createResponse()->withStatus($statusCode)->getReasonPhrase();
//        $errorMessage = sprintf('%s %s', $statusCode, $reasonPhrase);
        $errorMessage = [
            'Status Code' => $statusCode,
            'Reason' => $reasonPhrase
        ];

        if ($displayErrorDetails === true) {
//            $errorMessage = sprintf(
//                '%s - Error details: %s',
//                $errorMessage,
//                ExceptionDetail::getExceptionText($exception)
//            );
            $errorMessage = [
                'Error' => $errorMessage,
                'Details' => ExceptionDetail::getExceptionText($exception)
            ];
        }

        return $errorMessage;
    }
}