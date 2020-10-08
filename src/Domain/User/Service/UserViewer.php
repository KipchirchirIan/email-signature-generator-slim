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
use App\Factory\LoggerFactory;
use Exception;
use Psr\Log\LoggerInterface;

final class UserViewer
{
    /**
     * @var UserViewerRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserViewer constructor.
     *
     * @param UserViewerRepository $repository The repository
     * @param LoggerFactory $logger The logger factory
     */
    public function __construct(UserViewerRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('user_viewer.log')
            ->createInstance('user_viewer');
    }

    /**
     * @param int $userId The user id
     *
     * @return UserViewData The user
     */
    public function getUserViewData(int $userId): UserViewData
    {
       try {
           // Input Validation
           //....

           // Fetch data from the database
           $userRow = $this->repository->getUserById($userId);

           $user = new UserViewData($userRow);
//        $user->id = $userId;

           $this->logger->info(sprintf('User retrieved successfully: %s', $user->id));

           return $user;
       } catch (Exception $exception) {
           // Log error message
           $this->logger->error($exception->getMessage());

           throw $exception;
       }
    }
}