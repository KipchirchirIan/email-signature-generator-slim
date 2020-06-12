<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 6/3/20
 * Time: 10:36 PM
 */

namespace App\Action\UserTemplate;


use App\Domain\UserTemplate\Service\UserTemplateCreator;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserTemplateCreateAction
{
    private $userTemplateCreator;
    private $responder;

    public function __construct(Responder $responder, UserTemplateCreator $userTemplateCreator)
    {
        $this->responder = $responder;
        $this->userTemplateCreator = $userTemplateCreator;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $userId = $args['id'];
        $data = (array)$request->getParsedBody();

        $templateId = $data['tplid'];

        // Invoke domain with args and retain results
        $userTemplateId = $this->userTemplateCreator->createUserTemplate($userId, $templateId);

        $viewData = [
            "userTemplateId" => $userTemplateId
        ];

        return $this->responder->json($response, $viewData);
    }
}