<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/16/20
 * Time: 3:17 PM
 */

namespace App\Domain\UserImage\Service;


use App\Domain\UserImage\Repository\UserImageViewerRepository;
use App\Factory\LoggerFactory;
use DomainException;
use Exception;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

final class UserImageViewer
{
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(UserImageViewerRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('userimage_viewer.log')
            ->createInstance('userimage_viewer');
    }

    public function getUserImageViewData(int $userId): array
    {
        try {
            // Input validation
            if (empty($userId) || $userId < 1) {
                throw new InvalidArgumentException('User ID is required or must be a positive integer');
            }

            // Fetch from the database
            $userImageRow = $this->repository->getUserImageByUserId($userId);
            $this->logger->info(sprintf('User image retrieved successfully: %s', $userId));

            return $userImageRow;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}