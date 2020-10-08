<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/13/20
 * Time: 5:09 PM
 */

namespace App\Domain\User\Service;


use App\Domain\User\Repository\UserDeleteRepository;
use App\Factory\LoggerFactory;
use Exception;
use Psr\Log\LoggerInterface;

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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserDelete constructor.
     *
     * @param UserDeleteRepository $repository The repository
     */
    public function __construct(UserDeleteRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('user_delete.log')
            ->createInstance('user_delete');
    }

    /**
     * @param int $userId The user id
     *
     * @return bool Rows deleted
     */
    public function deleteUserData(int $userId): bool
    {
        try {
            $result = (bool)$this->repository->deleteUserById($userId);
            // Log success
            $this->logger->info(sprintf('User removed successfully: %s', $userId));

            return $result;
        } catch (Exception $exception) {
            // Log error message
            $this->logger->error($exception->getMessage());

            throw $exception;
        }
    }
}