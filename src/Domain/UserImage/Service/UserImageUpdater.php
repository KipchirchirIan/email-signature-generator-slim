<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/18/20
 * Time: 6:05 AM
 */

namespace App\Domain\UserImage\Service;


use App\Domain\UserImage\Data\UserImageUpdaterData;
use App\Domain\UserImage\Repository\UserImageUpdaterRepository;
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

final class UserImageUpdater
{
    /**
     * @var UserImageUpdaterRepository The repository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserImageUpdater constructor.
     *
     * @param UserImageUpdaterRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(UserImageUpdaterRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('userimage_updater.log')
            ->createInstance('userimage_updater');
    }

    /**
     * @param UserImageUpdaterData $userImageData The user image data
     * @param int $userId The user ID
     *
     * @return bool <b>FALSE</b> if zero rows affected<br>
     * <b>TRUE</b> if one or more rows affected
     */
    public function editUserImage(UserImageUpdaterData $userImageData, int $userId): bool
    {
        try {
            // Input validation
            if (empty($userId) || $userId < 1) {
                throw new InvalidArgumentException('User ID is required or must be a positive integer');
            }

            $result = $this->repository->updateUserImage($userImageData, $userId);
            $this->logger->info(sprintf('User image updated successfully: %s', $userId));

            return $result;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}