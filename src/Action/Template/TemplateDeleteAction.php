<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/21/20
 * Time: 9:40 PM
 */

namespace App\Action\Template;


use App\Domain\Template\Service\TemplateDelete;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TemplateDeleteAction
{
    /**
     * @var TemplateDelete
     */
    private $templateDelete;
    /**
     * @var Responder
     */
    private $responder;

    /**
     * TemplateDeleteAction constructor.
     *
     * @param TemplateDelete $templateDelete The service
     * @param Responder $responder The responder
     */
    public function __construct(TemplateDelete $templateDelete, Responder $responder)
    {
        $this->responder = $responder;
        $this->templateDelete = $templateDelete;
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
        $templateId = (int)$args['id'];

        $result = $this->templateDelete->deleteTemplateData($templateId);

        $viewData = [
            'result' => $result
        ];

        return $this->responder->json($response, $viewData);
    }
}