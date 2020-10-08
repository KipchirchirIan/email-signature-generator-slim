<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/20/20
 * Time: 2:54 AM
 */

namespace App\Domain\Social\Service;


use App\Domain\Social\Repository\SocialViewerRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class SocialListDataTable
{
    /**
     * @var SocialViewerRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SocialListDataTable constructor.
     *
     * @param SocialViewerRepository $repository The repository
     * @param LoggerFactory $logger
     */
    public function __construct(SocialViewerRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('social_lister.log')
            ->createInstance('social_lister');
    }

    /**
     * List all social media platforms
     *
     * @return array A list of social media platforms
     */
    public function listAllSocials(): array
    {
        $socialsList = $this->repository->findAllSocials();

        $this->logger->info(sprintf('Listing all records of social media accounts: %s', count($socialsList)));
        return $socialsList;
    }
}