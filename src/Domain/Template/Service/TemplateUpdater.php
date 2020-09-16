<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/27/20
 * Time: 6:28 PM
 */

namespace App\Domain\Template\Service;


use App\Domain\Template\Data\TemplateCreatorData;
use App\Domain\Template\Repository\TemplateUpdaterRepository;
use http\Exception\InvalidArgumentException;

final class TemplateUpdater
{
    /**
     * @var TemplateUpdaterRepository
     */
    private $repository;

    /**
     * TemplateUpdater constructor.
     *
     * @param TemplateUpdaterRepository $repository The repository
     */
    public function __construct(TemplateUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param TemplateCreatorData $template The template
     * @param int $templateId The template id
     *
     * @return bool success or fail
     */
    public function editTemplate(TemplateCreatorData $template, int $templateId): bool
    {
        if (empty($templateId) || !is_int($templateId)) {
            throw new InvalidArgumentException('Template ID is required or must be an integer');
        }

        // Update template
        return $this->repository->updateTemplateById($template, $templateId);
    }
}