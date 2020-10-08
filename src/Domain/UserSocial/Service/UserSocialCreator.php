<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 5:16 AM
 */

namespace App\Domain\UserSocial\Service;


use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\UserSocial\Data\UserSocialCreatorData;
use App\Domain\UserSocial\Repository\UserSocialCreatorRepository;
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

final class UserSocialCreator
{
    /**
     * @var UserSocialCreatorRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserSocialCreator constructor.
     *
     * @param UserSocialCreatorRepository $repository The repository
     */
    public function __construct(UserSocialCreatorRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('usersocial_creator.log')
            ->createInstance('usersocial_creator');
    }

    /**
     * Create a new social media profile of user
     *
     * @param UserSocialCreatorData $userSocial The user's social media profile data
     * @param int $userId The user ID
     *
     * @return int ID of last inserted record
     */
    public function createUserSocial(UserSocialCreatorData $userSocial, int $userId): int
    {
        try {
            //TODO: Validation
            if (!is_int($userId) || $userId < 1) {
                throw new InvalidArgumentException("User ID is required or must be a positive integer");
            }

            if (!is_int($userSocial->socialId) || $userSocial->socialId < 1) {
                throw new InvalidArgumentException("Social ID is required or must be a positive integer");
            }

            if (empty($userSocial->profileUsername)) {
                throw new InvalidArgumentException("Profile username is required");
            }

            $userSocialId = $this->repository->insertUserSocial($userSocial, $userId);

            // Log data
            $this->logger->info(sprintf('Social accounts for user with id %s created successfully: %s', $userId, $userSocialId));

            return $userSocialId;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}