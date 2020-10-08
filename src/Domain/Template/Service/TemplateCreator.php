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
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * TemplateCreator constructor.
     *
     * @param TemplateCreatorRepository $repository The repository
     */
    public function __construct(TemplateCreatorRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('template_creator.log')
            ->createInstance('template_creator');
    }

    /**
     * @param TemplateCreatorData $template The template
     *
     * @return int Id of last inserted template
     */
    public function createTemplate(TemplateCreatorData $template): int
    {
        try {
            // Validation
            if (empty($template->filename)) {
                throw new InvalidArgumentException('File name required');
            }

            // Insert new template
            $templateId = $this->repository->insertTemplate($template);

            // Log data
            $this->logger->info(sprintf('Template created successfully: %s', $templateId));

            return $templateId;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());

            throw $exception;
        }
    }
}