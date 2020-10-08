<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 1:24 AM
 */

namespace App\Domain\Social\Service;


use App\Domain\Social\Repository\SocialDeleteRepository;
use App\Factory\LoggerFactory;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

final class SocialDelete
{
    /**
     * @var SocialDeleteRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SocialDelete constructor.
     *
     * @param SocialDeleteRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(SocialDeleteRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('social_delete.log')
            ->createInstance('social_delete');
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

        $result = $this->repository->deleteSocialById($socialId);
        $this->logger->info(sprintf('Social media account deleted successfully: %s', $socialId));

        return $result;
    }
}