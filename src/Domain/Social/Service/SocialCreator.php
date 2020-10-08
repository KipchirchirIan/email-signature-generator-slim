<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/19/20
 * Time: 4:05 AM
 */

namespace App\Domain\Social\Service;


use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Repository\SocialCreatorRepository;
use App\Factory\LoggerFactory;
use Exception;
use Psr\Log\LoggerInterface;

final class SocialCreator
{
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SocialCreator constructor.
     *
     * @param SocialCreatorRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(SocialCreatorRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('social_creator.log')
            ->createInstance('social_creator');
    }

    public function createSocial(SocialCreatorData $socialData): int
    {
        try {
            // TODO: Validation

            // Insert social
            $socialId = $this->repository->insertSocial($socialData);

            // Log data
            $this->logger->info(sprintf('Social media account created successfully: %s', $socialId));

            return $socialId;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}