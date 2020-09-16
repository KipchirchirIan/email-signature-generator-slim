<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/21/20
 * Time: 10:36 PM
 */

namespace App\Domain\Template\Service;


use App\Domain\Template\Repository\TemplateDeleteRepository;

final class TemplateDelete
{
    /**
     * @var TemplateDeleteRepository
     */
    private $repository;

    /**
     * TemplateDelete constructor.
     *
     * @param TemplateDeleteRepository $repository The repository
     */
    public function __construct(TemplateDeleteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $templateId The template
     *
     * @return bool The result
     */
    public function deleteTemplateData(int $templateId)
    {
        return (bool)$this->repository->deleteTemplateById($templateId);
    }
}