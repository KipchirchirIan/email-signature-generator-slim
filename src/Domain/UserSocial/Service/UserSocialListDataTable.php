<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/22/20
 * Time: 5:37 AM
 */

namespace App\Domain\UserSocial\Service;


use App\Domain\UserSocial\Repository\UserSocialViewerRepository;
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

final class UserSocialListDataTable
{
    /**
     * @var UserSocialViewerRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserSocialListDataTable constructor.
     *
     * @param UserSocialViewerRepository $repository The repository
     * @param LoggerFactory $logger;
     */
    public function __construct(UserSocialViewerRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('usersocial_lister.log')
            ->createInstance('usersocial_lister');
    }

    /**
     * List all user's social media accounts
     *
     * @param int $userId The User ID
     *
     * @return array User's list of social media accounts
     */
    public function listAllUserSocials(int $userId): array
    {
        try {
            // Input validation
            if (empty($userId) || $userId < 1) {
                throw new InvalidArgumentException('User ID is required or must be a positive integer');
            }

            $userSocialsList = $this->repository->findAllUserSocialsById($userId);
            $this->logger->info(sprintf('Listing all social media accounts for user with id %s: %s', $userId, count($userSocialsList)));

            return $userSocialsList;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}