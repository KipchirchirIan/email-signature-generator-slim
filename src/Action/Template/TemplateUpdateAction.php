<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/27/20
 * Time: 5:48 PM
 */

namespace App\Action\Template;


use App\Domain\Template\Data\TemplateCreatorData;
use App\Domain\Template\Service\TemplateUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TemplateUpdateAction
{
    /**
     * @var TemplateUpdater
     */
    private $templateUpdater;
    /**
     * @var Responder
     */
    private $responder;

    /**
     * TemplateUpdateAction constructor.
     *
     * @param TemplateUpdater $templateUpdater The template
     * @param Responder $responder The responder
     */
    public function __construct(TemplateUpdater $templateUpdater, Responder $responder)
    {
        $this->templateUpdater = $templateUpdater;
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
        $data = (array)$request->getParsedBody();
        $templateId = $args['id'];

        $template = new TemplateCreatorData($data);

        $result = $this->templateUpdater->editTemplate($template, $templateId);

        $viewData = [
            'result' => $result
        ];

        return $this->responder->json($response, $viewData);
    }
}