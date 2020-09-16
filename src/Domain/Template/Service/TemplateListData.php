<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/16/20
 * Time: 7:27 AM
 */

namespace App\Domain\Template\Service;


use App\Domain\Template\Repository\TemplateViewerRepository;

/**
 * Class TemplateListData
 * @package App\Domain\Template\Service
 */
final class TemplateListData
{
    /**
     * @var TemplateViewerRepository
     */
    private $repository;

    /**
     * TemplateListData constructor.
     *
     * @param TemplateViewerRepository $repository The repository
     */
    public function __construct(TemplateViewerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array The list of templates
     */
    public function listAllTemplates(): array
    {
        return $this->repository->findAllTemplates();
    }
}