<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/8/20
 * Time: 2:46 AM
 */

namespace App\Domain\UserImage\Service;


use App\Domain\UserImage\Data\UserImageCreatorData;
use App\Domain\UserImage\Repository\UserImageCreatorRepository;
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use DomainException;
use Psr\Log\LoggerInterface;

final class UserImageCreator
{
    /**
     * @var UserImageCreatorRepository The repository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserImageCreator constructor.
     *
     * @param UserImageCreatorRepository $repository The repository
     */
    public function __construct(UserImageCreatorRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('userimage_creator.log')
            ->createInstance('userimage_creator');
    }

    /**
     * @param int $userId The user ID
     * @param UserImageCreatorData $userImage The user image
     *
     * @return int The new ID
     */
    public function createUserImage(int $userId, UserImageCreatorData $userImage): int
    {
        try {
            // Validation
            if (empty($userId) || !is_int($userId)) {
                throw new InvalidArgumentException('User ID is required or must be an integer');
            }

            //Todo: Check if user exists??
//        if (!$this->repository->userExists($userId)) {
//            throw new DomainException(sprintf('User not found: %d', $userId));
//        }

            // Todo: Check if user has an entry in the database already and just do an update
            // Insert data
            $userImageId = $this->repository->insertUserImage($userId, $userImage);

            // Log data
            $this->logger->info(sprintf('User image created successfully: %s', $userImageId));

            return $userImageId;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}