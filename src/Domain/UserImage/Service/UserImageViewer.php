<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/16/20
 * Time: 3:17 PM
 */

namespace App\Domain\UserImage\Service;


use App\Domain\UserImage\Repository\UserImageViewerRepository;
use DomainException;
use http\Exception\InvalidArgumentException;

final class UserImageViewer
{
    private $repository;

    public function __construct(UserImageViewerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUserImageViewData(int $userId): array
    {
        // Input validation
        if (empty($userId) || $userId < 1) {
            throw new InvalidArgumentException('User ID is required or must be a positive integer');
        }

        // Fetch from the database
        $userImageRow = $this->repository->getUserImageByUserId($userId);

        return $userImageRow;
    }
}