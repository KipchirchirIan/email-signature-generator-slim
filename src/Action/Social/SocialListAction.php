<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/20/20
 * Time: 1:57 AM
 */

namespace App\Action\Social;


use App\Domain\Social\Service\SocialListDataTable;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SocialListAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var SocialListDataTable
     */
    private $socialListDataTable;

    /**
     * SocialListAction constructor.
     *
     * @param SocialListDataTable $socialListDataTable The service
     * @param Responder $responder The responder
     */
    public function __construct(SocialListDataTable $socialListDataTable, Responder $responder)
    {
        $this->responder = $responder;
        $this->socialListDataTable = $socialListDataTable;
    }

    /**
     * Action
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->responder->json($response, $this->socialListDataTable->listAllSocials());
    }
}