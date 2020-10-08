<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/28/20
 * Time: 5:39 PM
 */

namespace App\Domain\User\Service;


use App\Domain\User\Data\UserCreatorData;
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use App\Domain\User\Repository\UserCreatorRepository;
use Psr\Log\LoggerInterface;

final class UserCreator
{
    /**
     * @var UserCreatorRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;


    public function __construct(UserCreatorRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('user_creator.log')
            ->createInstance('user_creator');
    }

    /**
     * @param UserCreatorData $user The user
     *
     * @return int Id of last row inserted
     *
     * @throws Exception
     * @throws \InvalidArgumentException
     */
    public function createUser(UserCreatorData $user): int
    {
        try {
            // Validation
            if (empty($user->email)) {
                throw new InvalidArgumentException('Email required');
            }

            // Insert user
            $userId = $this->repository->insertUser($user);

            // Log success
            $this->logger->info(sprintf('User created successfully: %s', $userId));

            return $userId;
        } catch (Exception $exception) {
            // Log error message
            $this->logger->error($exception->getMessage());

            throw $exception;
        }
    }
}