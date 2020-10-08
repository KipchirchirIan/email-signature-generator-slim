<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/16/20
 * Time: 7:27 AM
 */

namespace App\Domain\Template\Service;


use App\Domain\Template\Repository\TemplateViewerRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * TemplateListData constructor.
     *
     * @param TemplateViewerRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(TemplateViewerRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('template_lister.log')
            ->createInstance('template_lister');
    }

    /**
     * @return array The list of templates
     */
    public function listAllTemplates(): array
    {
        $templateList = $this->repository->findAllTemplates();
        $this->logger->info(sprintf('Listing all records of templates: %s', count($templateList)));

        return $templateList;
    }
}