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
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

final class TemplateUpdater
{
    /**
     * @var TemplateUpdaterRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * TemplateUpdater constructor.
     *
     * @param TemplateUpdaterRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(TemplateUpdaterRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('template_updater.log')
            ->createInstance('template_update');
    }

    /**
     * @param TemplateCreatorData $template The template
     * @param int $templateId The template id
     *
     * @return bool success or fail
     */
    public function editTemplate(TemplateCreatorData $template, int $templateId): bool
    {
        try {
            if (empty($templateId) || !is_int($templateId)) {
                throw new InvalidArgumentException('Template ID is required or must be an integer');
            }
            // Update template
            $result = $this->repository->updateTemplateById($template, $templateId);
            $this->logger->info(sprintf('User updated successfully: %s', $templateId));

            return $result;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}