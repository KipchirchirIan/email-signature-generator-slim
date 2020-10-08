<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/20/20
 * Time: 12:14 AM
 */

namespace App\Domain\Social\Service;


use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Data\SocialViewData;
use App\Domain\Social\Repository\SocialViewerRepository;
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

final class SocialViewer
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
     * SocialViewer constructor.
     *
     * @param SocialViewerRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(SocialViewerRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('social_viewer.log')
            ->createInstance('social_viewer');
    }

    /**
     * Read a social media data
     *
     * @param int $socialId The social media ID
     *
     * @return SocialViewData The social media platform
     */
    public function getSocialViewData(int $socialId): SocialViewData
    {
        try {
            // Input validation
            // TODO: Use a class...
            if (empty($socialId) || $socialId < 1) {
                throw new InvalidArgumentException('Social ID is required or must be a positive integer');
            }

            // Fetch data from the database
            $socialData = $this->repository->getSocialById($socialId);

            // Add or invoke your complex business logic here
            $social = new SocialViewData($socialData);

            $this->logger->info(sprintf('Social media account retrieved successfully: %s', $social->socialId));

            return $social;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}