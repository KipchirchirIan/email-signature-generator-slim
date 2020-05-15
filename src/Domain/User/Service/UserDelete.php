<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/13/20
 * Time: 5:09 PM
 */

namespace App\Domain\User\Service;


use App\Domain\User\Repository\UserDeleteRepository;

/**
 * Class UserDelete
 * @package App\Domain\User\Service
 */
final class UserDelete
{
    /**
     * @var UserDeleteRepository
     */
    private $repository;

    /**
     * UserDelete constructor.
     *
     * @param UserDeleteRepository $repository The repository
     */
    public function __construct(UserDeleteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId The user id
     *
     * @return bool Rows deleted
     */
    public function deleteUserData(int $userId): bool
    {
        return (bool)$this->repository->deleteUserById($userId);
    }
}