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
use http\Exception\InvalidArgumentException;
use DomainException;

final class UserImageCreator
{
    /**
     * @var UserImageCreatorRepository The repository
     */
    private $repository;

    /**
     * UserImageCreator constructor.
     *
     * @param UserImageCreatorRepository $repository The repository
     */
    public function __construct(UserImageCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId The user ID
     * @param UserImageCreatorData $userImage The user image
     *
     * @return int The new ID
     */
    public function createUserImage(int $userId, UserImageCreatorData $userImage): int
    {
        // Validation
        if (empty($userId) || !is_int($userId)) {
            throw new InvalidArgumentException('User ID is required or must be an integer');
        }

        // Check if user exists
//        if (!$this->repository->userExists($userId)) {
//            throw new DomainException(sprintf('User not found: %d', $userId));
//        }

        // Insert data
        $userImageId = $this->repository->insertUserImage($userId, $userImage);

        // Logging done here: User images created successfully

        return $userImageId;
    }
}