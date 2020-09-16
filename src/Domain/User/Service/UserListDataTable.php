<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/29/20
 * Time: 1:50 PM
 */

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserListDataTableRepository;

final class UserListDataTable
{
    /**
     * @var UserListDataTableRepository
     */
    private $repository;

    /**
     * UserListDataTable constructor.
     *
     * @param UserListDataTableRepository $repository The repository
     */
    public function __construct(UserListDataTableRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array The result set
     */
    public function listAllUsers(): array
    {
        return $this->repository->getTableData();
    }
}