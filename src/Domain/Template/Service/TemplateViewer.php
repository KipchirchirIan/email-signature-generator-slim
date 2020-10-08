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
use App\Factory\LoggerFactory;
use Exception;
use Psr\Log\LoggerInterface;

final class TemplateViewer
{
    /**
     * @var TemplateViewerRepository The repository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * TemplateViewer constructor.
     *
     * @param TemplateViewerRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(TemplateViewerRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('template_viewer.log')
            ->createInstance('template_viewer');
    }

    /**
     * @param int $templateId The template Id
     *
     * @return array The template
     */
    public function getTemplateViewData(int $templateId): array
    {
        try {
            // Input validation
            // ...

            // Fetch data from database
            $template = $this->repository->getTemplateById($templateId);

            // Add or invoke your complex business logic here
//        $template = (array)new TemplateCreatorData($templateRow);
            $this->logger->info(sprintf('Template retrieved successfully: %s', $templateId));

            return $template;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());

            throw $exception;
        }
    }
}