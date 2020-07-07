<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 6/12/20
 * Time: 11:20 PM
 */

namespace App\Action\UserTemplate;


use App\Domain\UserTemplate\Service\UserTemplateViewer;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserTemplateViewAction
{
    /**
     * @var Responder The response
     */
    private $responder;

    /**
     * @var UserTemplateViewer The service
     */
    private $userTemplateViewer;

    /**
     * UserTemplateViewAction constructor.
     *
     * @param Responder $responder The response
     *
     * @param UserTemplateViewer $userTemplateViewer The service
     */
    public function __construct(Responder $responder, UserTemplateViewer $userTemplateViewer)
    {
        $this->responder = $responder;
        $this->userTemplateViewer = $userTemplateViewer;
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

        // Invoke the service class
        $templates = $this->userTemplateViewer->getUserTemplateData($userId);

        // Prepare the view data
        $viewData = [
            'templates' => $templates
        ];

        return $this->responder->json($response, $viewData);
    }
}