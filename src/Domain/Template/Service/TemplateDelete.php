<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/21/20
 * Time: 10:36 PM
 */

namespace App\Domain\Template\Service;


use App\Domain\Template\Repository\TemplateDeleteRepository;
use App\Factory\LoggerFactory;
use Exception;
use Psr\Log\LoggerInterface;

final class TemplateDelete
{
    /**
     * @var TemplateDeleteRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * TemplateDelete constructor.
     *
     * @param TemplateDeleteRepository $repository The repository
     */
    public function __construct(TemplateDeleteRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('template_delete.log')
            ->createInstance('template_delete');
    }

    /**
     * @param int $templateId The template
     *
     * @return bool The result
     */
    public function deleteTemplateData(int $templateId)
    {
        try {
            $result = (bool)$this->repository->deleteTemplateById($templateId);
            $this->logger->info(sprintf('Template deleted successfully: %s', $templateId));

            return $result;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}