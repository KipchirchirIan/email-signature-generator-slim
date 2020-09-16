<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/10/20
 * Time: 10:42 AM
 */

namespace App\Domain\User\Service;


use App\Domain\User\Repository\SuperUserAuthRepository;

final class SuperUserAuth
{
    private $repository;

    public function __construct(SuperUserAuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authenticate(string $email, string $password): ?array
    {
        $superUserRow = $this->repository->findSuperUserByEmail($email);

        if (!$superUserRow) {
            return null;
        }

        if (!password_verify($password, (string)$superUserRow['password'])) {
            return null;
        }

        return $superUserRow;
    }
}