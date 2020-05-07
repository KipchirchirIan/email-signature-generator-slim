<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/4/20
 * Time: 4:57 PM
 */

namespace App\Domain\User\Service;


use App\Domain\User\Repository\UserViewerRepository;
use App\Domain\User\Data\UserViewData;

final class UserViewer
{
    /**
     * @var UserViewerRepository
     */
    private $repository;

    /**
     * UserViewer constructor.
     *
     * @param UserViewerRepository $repository The repository
     */
    public function __construct(UserViewerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId The user id
     *
     * @return UserViewData The user
     */
    public function getUserViewData(int $userId): UserViewData
    {
        // Input Validation
        //....

        // Fetch data from the database
        $userRow = $this->repository->getUserById($userId);

        // Add or invoke your complex business logic here
        $user = new UserViewData();
        $user->id = (int)$userRow['user_id'];
        $user->email = (string)$userRow['email'];
        $user->name = (string)$userRow['name'];

        return $user;
    }
}