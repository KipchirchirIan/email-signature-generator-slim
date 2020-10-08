<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 6/12/20
 * Time: 11:37 PM
 */

namespace App\Domain\UserTemplate\Service;


use App\Domain\UserTemplate\Repository\UserTemplateViewerRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class UserTemplateViewer
{
    /**
     * @var UserTemplateViewerRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserTemplateViewer constructor.
     *
     * @param UserTemplateViewerRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(UserTemplateViewerRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('usertemplate_viewer.log')
            ->createInstance('usertemplate_viewer');
    }

    /**
     * @param int $userId The User ID
     *
     * @return array List of templates
     */
    public function getUserTemplateData(int $userId): array
    {
        $savedTemplates = $this->repository->findAllUserTemplateByUserId($userId);
        $this->logger->info(sprintf('Listing templates of user with id %s: %s', $userId, count($savedTemplates)));

        return $savedTemplates;
    }
}