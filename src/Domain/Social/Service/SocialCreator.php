<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/19/20
 * Time: 4:05 AM
 */

namespace App\Domain\Social\Service;


use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Repository\SocialCreatorRepository;

final class SocialCreator
{
    private $repository;

    public function __construct(SocialCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createSocial(SocialCreatorData $socialData): int
    {
        // TODO: Validation

        // Insert social
        $socialId = $this->repository->insertSocial($socialData);

        // TODO: Logging

        return $socialId;
    }
}