<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/30/20
 * Time: 12:17 PM
 */

namespace App\Domain\User\Service;


use App\Domain\User\Data\UserCreatorData;
use App\Domain\User\Repository\UserUpdaterRepository;
use http\Exception\InvalidArgumentException;

/**
 * Class UserUpdater
 * @package App\Domain\User\Service
 */
final class UserUpdater
{
    /**
     * @var UserUpdaterRepository
     */
    private $repository;

    /**
     * UserUpdater constructor.
     *
     * @param UserUpdaterRepository $repository
     */
    public function __construct(UserUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserCreatorData $user The user
     * @param int $uid Id of the user
     *
     * @return bool The result-success or fail
     */
    public function editUser(UserCreatorData $user, int $uid): bool
    {
        if (empty($uid) || !is_int($uid)) {
            throw new InvalidArgumentException('User ID is required or must be an integer');
        }

        // Update user
        $result = $this->repository->updateUser($user, $uid);

        return $result;
    }
}