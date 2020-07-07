<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/7/20
 * Time: 4:22 AM
 */

namespace App\Action\UserTemplate;


use App\Domain\UserTemplate\Service\UserTemplateDelete;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserTemplateDeleteAction
{
    /**
     * @var Responder The responder
     */
    private $responder;
    /**
     * @var UserTemplateDelete The service
     */
    private $userTemplateDelete;

    /**
     * UserTemplateDeleteAction constructor.
     *
     * @param UserTemplateDelete $userTemplateDelete The service
     * @param Responder $responder The responder
     */
    public function __construct(UserTemplateDelete $userTemplateDelete, Responder $responder)
    {
        $this->responder = $responder;
        $this->userTemplateDelete = $userTemplateDelete;
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
        $userId = $args['id'];
        $data = (array)$request->getParsedBody();
        $userTemplateId = (int)$data['userTemplateId'];

        // Invoke the service class
        $result = $this->userTemplateDelete->deleteUserTemplateData($userId, $userTemplateId);

        $viewData = [
            'message' => $result
        ];

        return $this->responder->json($response, $viewData);
    }
}