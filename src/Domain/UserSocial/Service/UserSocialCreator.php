<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 5:16 AM
 */

namespace App\Domain\UserSocial\Service;


use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\UserSocial\Data\UserSocialCreatorData;
use App\Domain\UserSocial\Repository\UserSocialCreatorRepository;
use http\Exception\InvalidArgumentException;

final class UserSocialCreator
{
    /**
     * @var UserSocialCreatorRepository
     */
    private $repository;

    /**
     * UserSocialCreator constructor.
     *
     * @param UserSocialCreatorRepository $repository The repository
     */
    public function __construct(UserSocialCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new social media profile of user
     *
     * @param UserSocialCreatorData $userSocial The user's social media profile data
     * @param int $userId The user ID
     *
     * @return int ID of last inserted record
     */
    public function createUserSocial(UserSocialCreatorData $userSocial, int $userId): int
    {
        //TODO: Validation
        if (!is_int($userId) || $userId < 1) {
            throw new InvalidArgumentException("User ID is required or must be a positive integer");
        }

        if (!is_int($userSocial->socialId) || $userSocial->socialId < 1) {
            throw new InvalidArgumentException("Social ID is required or must be a positive integer");
        }

        if (empty($userSocial->profileUsername)) {
            throw new InvalidArgumentException("Profile username is required");
        }

        //TODO: Logging

        return $this->repository->insertUserSocial($userSocial, $userId);
    }
}