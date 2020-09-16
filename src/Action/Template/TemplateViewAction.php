<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/16/20
 * Time: 5:36 AM
 */

namespace App\Action\Template;


use App\Domain\Template\Service\TemplateViewer;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TemplateViewAction
{
    /**
     * @var Responder The responder
     */
    private $responder;
    /**
     * @var TemplateViewer The template
     */
    private $templateReader;

    /**
     * TemplateViewAction constructor.
     *
     * @param TemplateViewer $templateViewer The template
     * @param Responder $responder The responder
     */
    public function __construct(TemplateViewer $templateViewer, Responder $responder)
    {
        $this->templateReader = $templateViewer;
        $this->responder = $responder;
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
        // Fetch parameters from request
        $userId = (int)$args['id'];

        // Invoke the service class
        $template = $this->templateReader->getTemplateViewData($userId);

        // prepare the view data
        $viewData = [
            'template' => $template
        ];

        return $this->responder->json($response, $viewData);
    }
}