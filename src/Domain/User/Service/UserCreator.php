<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/28/20
 * Time: 5:39 PM
 */

namespace App\Domain\User\Service;


use App\Domain\User\Data\UserCreatorData;
use http\Exception\InvalidArgumentException;
use App\Domain\User\Repository\UserCreatorRepository;

final class UserCreator
{
    /**
     * @var UserCreatorRepository
     */
    private $repository;


    public function __construct(UserCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserCreatorData $user The user
     * @return int
     */
    public function createUser(UserCreatorData $user): int
    {
        // Validation
        if (empty($user->username)) {
            throw new InvalidArgumentException('Username required');
        }

        // Insert user
        $userId = $this->repository->insertUser($user);

        // Logging done here: User created successfully

        return $userId;
    }
}