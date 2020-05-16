<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/15/20
 * Time: 12:10 PM
 */

namespace App\Domain\Template\Service;


use App\Domain\Template\Data\TemplateCreatorData;
use App\Domain\Template\Repository\TemplateCreatorRepository;
use http\Exception\InvalidArgumentException;

/**
 * Class TemplateCreator
 * @package App\Domain\Template\Service
 */
final class TemplateCreator
{
    /**
     * @var TemplateCreatorRepository
     */
    private $repository;

    /**
     * TemplateCreator constructor.
     *
     * @param TemplateCreatorRepository $repository The repository
     */
    public function __construct(TemplateCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param TemplateCreatorData $template The template
     *
     * @return int Id of last inserted template
     */
    public function createTemplate(TemplateCreatorData $template): int
    {
        // Validation
        if (empty($template->filename)) {
            throw new InvalidArgumentException('File name required');
        }

        // Insert new template
        $templateId = $this->repository->insertTemplate($template);

        // Logging done here: Template created successfully

        return $templateId;
    }
}