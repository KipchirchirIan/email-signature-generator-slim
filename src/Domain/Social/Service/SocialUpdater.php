<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/20/20
 * Time: 6:11 AM
 */

namespace App\Domain\Social\Service;


use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Repository\SocialUpdaterRepository;
use http\Exception\InvalidArgumentException;

final class SocialUpdater
{
    /**
     * @var SocialUpdaterRepository
     */
    private $repository;

    /**
     * SocialUpdater constructor.
     *
     * @param SocialUpdaterRepository $repository The repository
     */
    public function __construct(SocialUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Edit details of social media platform by id
     *
     * @param SocialCreatorData $socialData The social media data
     * @param int $socialId The social ID
     *
     * @return bool <b>TRUE</b> if one or more rows is updated<br>
     * <b>FALSE</b> if zero rows are updated
     */
    public function editSocial(SocialCreatorData $socialData, int $socialId): bool
    {
        // Input validation
        if (empty($socialId) || $socialId < 1) {
            throw new InvalidArgumentException('Social ID is required or must be a positive integer');
        }

        return $this->repository->updateSocialById($socialData, $socialId);
    }
}