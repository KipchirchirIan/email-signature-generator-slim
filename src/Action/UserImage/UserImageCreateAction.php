<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/8/20
 * Time: 1:53 AM
 */

namespace App\Action\UserImage;


 use App\Domain\UserImage\Data\UserImageCreatorData;
 use App\Domain\UserImage\Service\UserImageCreator;
 use App\Responder\Responder;
 use Psr\Http\Message\ResponseInterface;
 use Psr\Http\Message\ServerRequestInterface;

 final class UserImageCreateAction
{
     /**
      * @var Responder The responder
      */
    private $responder;

     /**
      * @var UserImageCreator The domain service
      */
    private $userImageCreator;

     /**
      * UserImageCreateAction constructor.
      *
      * @param Responder $responder The responder
      * @param UserImageCreator $userImageCreator The service
      */
    public function __construct(Responder $responder, UserImageCreator $userImageCreator)
    {
        $this->responder = $responder;
        $this->userImageCreator = $userImageCreator;
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

        // Collect input from HTTP request
        $data = (array)$request->getParsedBody();

        $data['userId'] = $userId;

        $userImage = new UserImageCreatorData($data);

        // Invoke Domain with input and retain results
        $userImageId = $this->userImageCreator->createUserImage($userId, $userImage);

        $userImage->id = $userImageId;
        $viewData = [
            $userImageId => $userImage
        ];

        return $this->responder->json($response, $viewData);
    }
 }