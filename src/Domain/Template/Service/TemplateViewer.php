<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/16/20
 * Time: 7:26 AM
 */

namespace App\Domain\Template\Service;


use App\Domain\Template\Data\TemplateCreatorData;
use App\Domain\Template\Repository\TemplateViewerRepository;

final class TemplateViewer
{
    /**
     * @var TemplateViewerRepository The repository
     */
    private $repository;

    /**
     * TemplateViewer constructor.
     *
     * @param TemplateViewerRepository $repository The repository
     */
    public function __construct(TemplateViewerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $templateId The template Id
     *
     * @return array The template
     */
    public function getTemplateViewData(int $templateId): array
    {
        // Input validation
        // ...

        // Fetch data from database
        $template = $this->repository->getTemplateById($templateId);

        // Add or invoke your complex business logic here
//        $template = (array)new TemplateCreatorData($templateRow);

        return $template;
    }
}