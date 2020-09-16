<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/15/20
 * Time: 9:27 AM
 */

namespace App\Action\Template;


use App\Domain\Template\Data\TemplateCreatorData;
use App\Domain\Template\Service\TemplateCreator;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TemplateCreateAction
{
    /**
     * @var TemplateCreator
     */
    private $templateCreator;
    /**
     * @var Responder
     */
    private $responder;

    /**
     * TemplateCreateAction constructor.
     *
     * @param TemplateCreator $templateCreator The service
     * @param Responder $responder The responder
     */
    public function __construct(TemplateCreator $templateCreator, Responder $responder)
    {
        $this->responder = $responder;
        $this->templateCreator = $templateCreator;
    }

    /**
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Collect input from HTTP request
        $data = (array)$request->getParsedBody();

        $template = new TemplateCreatorData($data);

        // Invoke domain service with input and retain results
        $templateId = $this->templateCreator->createTemplate($template);

        // Transform the result into JSON
        $viewData = [
            'template_id' => $templateId
        ];

        return $this->responder->json($response, $viewData);
    }
}