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
use http\Exception\InvalidArgumentException;

final class UserImageUpdater
{
    /**
     * @var UserImageUpdaterRepository The repository
     */
    private $repository;

    /**
     * UserImageUpdater constructor.
     *
     * @param UserImageUpdaterRepository $repository The repository
     */
    public function __construct(UserImageUpdaterRepository $repository)
    {
        $this->repository = $repository;
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
        // Input validation
        if (empty($userId) || $userId < 1) {
            throw new InvalidArgumentException('User ID is required or must be a positive integer');
        }

        return $this->repository->updateUserImage($userImageData, $userId);
    }
}