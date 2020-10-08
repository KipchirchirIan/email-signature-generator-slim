<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/29/20
 * Time: 1:50 PM
 */

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserListDataTableRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class UserListDataTable
{
    /**
     * @var UserListDataTableRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserListDataTable constructor.
     *
     * @param UserListDataTableRepository $repository The repository
     */
    public function __construct(UserListDataTableRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('user_lister.log')
            ->createInstance('user_lister');
    }

    /**
     * @return array The result set
     */
    public function listAllUsers(): array
    {
        $userList = $this->repository->getTableData();

        $this->logger->info(sprintf('Listing all records of users: %s', count($userList)));

        return $userList;
    }
}