<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 1:24 AM
 */

namespace App\Domain\Social\Service;


use App\Domain\Social\Repository\SocialDeleteRepository;
use http\Exception\InvalidArgumentException;

final class SocialDelete
{
    /**
     * @var SocialDeleteRepository
     */
    private $repository;

    /**
     * SocialDelete constructor.
     *
     * @param SocialDeleteRepository $repository The repository
     */
    public function __construct(SocialDeleteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Remove social media platform by id
     *
     * @param int $socialId The social ID
     *
     * @return bool <b>TRUE</b> if one or more rows is deleted<br>
     * <b>FALSE</b> if zero rows are deleted
     */
    public function removeSocialById(int $socialId): bool
    {
        // Input validation
        if (empty($socialId) || $socialId < 1) {
            throw new InvalidArgumentException('Social ID is required or must be a positive integer');
        }

        return $this->repository->deleteSocialById($socialId);
    }
}