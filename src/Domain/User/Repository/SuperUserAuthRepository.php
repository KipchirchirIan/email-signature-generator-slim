<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/10/20
 * Time: 10:26 AM
 */

namespace App\Domain\User\Repository;

use DomainException;
use PDO;

class SuperUserAuthRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findSuperUserByEmail($email): array
    {
        $params = [
            'email' => $email
        ];

        $sql = "SELECT * FROM tbl_superusers WHERE email = :email LIMIT 1";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        return $row;
    }
}