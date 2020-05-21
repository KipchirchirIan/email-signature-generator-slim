<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/21/20
 * Time: 3:43 AM
 */

namespace App\Action\Template;


use App\Domain\Template\Service\TemplateListData;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class TemplateListAction
 * @package App\Action\Template
 */
final class TemplateListAction
{
    /**
     * @var Responder The responder
     */
    private $responder;
    /**
     * @var TemplateListData The templates
     */
    private $templateList;

    /**
     * TemplateListAction constructor.
     *
     * @param TemplateListData $templateList The templates
     * @param Responder $responder The responder
     */
    public function __construct(TemplateListData $templateList, Responder $responder)
    {
        $this->responder = $responder;
        $this->templateList = $templateList;
    }

    /**
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->responder->json($response, $this->templateList->listAllTemplates());
    }
}