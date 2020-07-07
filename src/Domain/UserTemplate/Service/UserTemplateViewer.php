<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 6/12/20
 * Time: 11:37 PM
 */

namespace App\Domain\UserTemplate\Service;


use App\Domain\UserTemplate\Repository\UserTemplateViewerRepository;

final class UserTemplateViewer
{
    /**
     * @var UserTemplateViewerRepository
     */
    private $repository;

    /**
     * UserTemplateViewer constructor.
     *
     * @param UserTemplateViewerRepository $repository The repository
     */
    public function __construct(UserTemplateViewerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId The User ID
     *
     * @return array List of templates
     */
    public function getUserTemplateData(int $userId): array
    {
        return $this->repository->findAllUserTemplateByUserId($userId);
    }
}