<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/11/20
 * Time: 4:06 AM
 */

namespace App\Action\UserImage;


use App\Domain\UserImage\Service\UserImageViewer;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserImageViewAction
{
    private $responder;

    private $userImageViewer;

    public function __construct(UserImageViewer $userImageViewer, Responder $responder)
    {
        $this->userImageViewer = $userImageViewer;
        $this->responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $userId = (int)$args['id'];

        // Invoke domain service with input and retain results
        $userImageData = $this->userImageViewer->getUserImageViewData($userId);

        return $this->responder->json($response, $userImageData);
    }
}