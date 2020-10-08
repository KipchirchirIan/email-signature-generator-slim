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
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

final class SocialUpdater
{
    /**
     * @var SocialUpdaterRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SocialUpdater constructor.
     *
     * @param SocialUpdaterRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(SocialUpdaterRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('social_updater.log')
            ->createInstance('social_updater');
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
        try {
            // Input validation
            if (empty($socialId) || $socialId < 1) {
                throw new InvalidArgumentException('Social ID is required or must be a positive integer');
            }

            $result = $this->repository->updateSocialById($socialData, $socialId);
            $this->logger->info(sprintf('Social media account updated successfully: %s', $socialId));

            return $result;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}