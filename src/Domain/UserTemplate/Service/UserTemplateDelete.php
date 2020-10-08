<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/7/20
 * Time: 10:25 PM
 */

namespace App\Domain\UserTemplate\Service;


use App\Domain\UserTemplate\Repository\UserTemplateDeleteRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class UserTemplateDelete
{
    /**
     * @var UserTemplateDeleteRepository The repository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserTemplateDelete constructor.
     *
     * @param UserTemplateDeleteRepository $repository The repository
     */
    public function __construct(UserTemplateDeleteRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('usertemplate_delete.log')
            ->createInstance('usertemplate_delete');
    }

    /**
     * @param int $userId The User ID
     * @param int $userTemplateId The Template ID
     *
     * @return bool <b>TRUE</b> if 1 or more rows deleted<br>
     * <b>FALSE</b> if failed or 0 rows deleted.
     */
    public function deleteUserTemplateData(int $userId, int $userTemplateId): bool
    {
        $result = $this->repository->deleteUserTemplate($userId, $userTemplateId);
        $this->logger->info(
            sprintf(
                'User template with id %s has been removed from user with id %s saved list of templates: %s',
                $userTemplateId, $userId, $result
            )
        );

        return $result;
    }

    /**
     * @param int $userId The User ID
     *
     * @return bool <b>TRUE</b> if 1 or more rows deleted<br>
     * <b>FALSE</b> if failed or 0 rows deleted.
     */
    public function deleteAllUserTemplateData(int $userId): bool
    {
        $result = $this->repository->deleteAllUserTemplatesByUserId($userId);
        $this->logger->info(
            sprintf(
                'All templates for user with id %s have been deleted: %s',
                $userId, $result
            )
        );

        return $result;
    }
}