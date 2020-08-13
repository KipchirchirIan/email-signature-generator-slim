<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 6/10/20
 * Time: 8:28 PM
 */

namespace App\Domain\UserTemplate\Service;


use App\Domain\User\Repository\UserViewerRepository;
use App\Domain\User\Service\UserViewer;
use App\Domain\UserTemplate\Repository\UserTemplateCreatorRepository;
use http\Exception\InvalidArgumentException;
use DomainException;
use PDO;

final class UserTemplateCreator
{
    private $repository;

    public function __construct(UserTemplateCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUserTemplate(int $userId, int $templateId)
    {
        if ($userId < 1 || !is_int($userId)) {
            throw new InvalidArgumentException("User ID must be an integer and not less than 1");
        }

        if ($templateId < 1 || !is_int($templateId)) {
            throw new InvalidArgumentException("Template ID must be an integer and not less than 1");
        }

        // Todo: Should probably check if user exists
//        $user  = new UserViewer(new UserViewerRepository(new PDO()));
//        $userExists = $user->getUserViewData($userId);
//        if (!$this->repository->findUserById($userId)) {
//            throw new DomainException(sprintf('User does not exist: %d', $userId));
//        }

        // Todo: Should probably check if template exists
//        if (!$this->repository->getTemplateById($templateId)) {
//            throw new DomainException(sprintf('Template does not exist: %d', $templateId));
//        }

        // Todo: Check if user already has this template in their saved lists
        if ($this->repository->findUserTemplateByTemplateId($userId, $templateId)) {
            throw new DomainException(sprintf('User already has this template in their saved list'));
        }

        return $this->repository->insertUserTemplate($userId, $templateId);
    }
}