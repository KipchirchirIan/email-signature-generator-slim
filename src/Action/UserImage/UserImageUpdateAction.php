<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/18/20
 * Time: 5:45 AM
 */

namespace App\Action\UserImage;


use App\Domain\UserImage\Data\UserImageUpdaterData;
use App\Domain\UserImage\Service\UserImageUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserImageUpdateAction
{
    /**
     * @var UserImageUpdater The service
     */
    private $userImageUpdater;

    /**
     * @var Responder The responder
     */
    private $responder;

    /**
     * UserImageUpdateAction constructor.
     *
     * @param UserImageUpdater $userImageUpdater The service
     * @param Responder $responder The responder
     */
    public function __construct(UserImageUpdater $userImageUpdater, Responder $responder)
    {
        $this->responder = $responder;
        $this->userImageUpdater = $userImageUpdater;
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
        $userId = (int)$args['id'];
        $data = (array)$request->getParsedBody();

        $userImage = new UserImageUpdaterData($data);

        // Invoke the domain with input/args and retain results
        $result = $this->userImageUpdater->editUserImage($userImage, $userId);

        $viewData = [
            'message' => $result,
            'body' => $userImage
        ];

        return $this->responder->json($response, $viewData);
    }
}