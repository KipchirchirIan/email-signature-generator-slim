<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/7/20
 * Time: 10:25 PM
 */

namespace App\Domain\UserTemplate\Service;


use App\Domain\UserTemplate\Repository\UserTemplateDeleteRepository;

final class UserTemplateDelete
{
    /**
     * @var UserTemplateDeleteRepository The repository
     */
    private $repository;

    /**
     * UserTemplateDelete constructor.
     *
     * @param UserTemplateDeleteRepository $repository The repository
     */
    public function __construct(UserTemplateDeleteRepository $repository)
    {
        $this->repository = $repository;
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
        return $this->repository->deleteUserTemplate($userId, $userTemplateId);
    }

    /**
     * @param int $userId The User ID
     *
     * @return bool <b>TRUE</b> if 1 or more rows deleted<br>
     * <b>FALSE</b> if failed or 0 rows deleted.
     */
    public function deleteAllUserTemplateData(int $userId): bool
    {
        return $this->repository->deleteAllUserTemplatesByUserId($userId);
    }
}