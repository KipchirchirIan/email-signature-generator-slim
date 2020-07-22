<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/22/20
 * Time: 5:37 AM
 */

namespace App\Domain\UserSocial\Service;


use App\Domain\UserSocial\Repository\UserSocialViewerRepository;
use http\Exception\InvalidArgumentException;

final class UserSocialListDataTable
{
    /**
     * @var UserSocialViewerRepository
     */
    private $repository;

    /**
     * UserSocialListDataTable constructor.
     *
     * @param UserSocialViewerRepository $repository The repository
     */
    public function __construct(UserSocialViewerRepository $repository)
    {
        $this->repository = $repository;
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
        // Input validation
        if (empty($userId) || $userId < 1) {
            throw new InvalidArgumentException('User ID is required or must be a positive integer');
        }

        return $this->repository->findAllUserSocialsById($userId);
    }
}