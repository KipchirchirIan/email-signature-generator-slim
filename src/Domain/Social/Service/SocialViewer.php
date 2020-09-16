<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/20/20
 * Time: 12:14 AM
 */

namespace App\Domain\Social\Service;


use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Data\SocialViewData;
use App\Domain\Social\Repository\SocialViewerRepository;
use http\Exception\InvalidArgumentException;

final class SocialViewer
{
    /**
     * @var SocialViewerRepository
     */
    private $repository;

    /**
     * SocialViewer constructor.
     *
     * @param SocialViewerRepository $repository The repository
     */
    public function __construct(SocialViewerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a social media data
     *
     * @param int $socialId The social media ID
     *
     * @return SocialViewData The social media platform
     */
    public function getSocialViewData(int $socialId): SocialViewData
    {
        // Input validation
        // TODO: Use a class...
        if (empty($socialId) || $socialId < 1) {
            throw new InvalidArgumentException('Social ID is required or must be a positive integer');
        }

        // Fetch data from the database
        $socialData = $this->repository->getSocialById($socialId);

        // Add or invoke your complex business logic here
        $social = new SocialViewData($socialData);

        return $social;
    }
}