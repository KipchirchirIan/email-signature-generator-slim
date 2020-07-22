<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/22/20
 * Time: 6:46 AM
 */

namespace App\Domain\UserSocial\Service;


use App\Domain\UserSocial\Data\UserSocialUpdaterData;
use App\Domain\UserSocial\Repository\UserSocialUpdaterRepository;
use http\Exception\InvalidArgumentException;

final class UserSocialUpdater
{
    /**
     * @var UserSocialUpdaterRepository
     */
    private $repository;

    /**
     * UserSocialUpdater constructor.
     *
     * @param UserSocialUpdaterRepository $repository The repository
     */
    public function __construct(UserSocialUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Edit user's social media profile username
     *
     * @param UserSocialUpdaterData $userSocial The user's social media profile data
     * @param int $userId The User ID
     *
     * @return bool <b>TRUE</b> if one or more rows is updated<br>
     * <b>FALSE</b> if zero rows are updated
     */
    public function editUserSocial(UserSocialUpdaterData $userSocial, int $userId): bool
    {
        //TODO: Input validation
        if (empty($userId) || $userId < 1) {
            throw new InvalidArgumentException('User ID is required or must be a positive integer');
        }

        if (empty($userSocial->profileUsername)) {
            throw new InvalidArgumentException('Profile username is required');
        }

        return $this->repository->updateUserSocials($userSocial, $userId);
    }
}