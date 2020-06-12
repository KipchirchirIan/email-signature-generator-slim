<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 6/3/20
 * Time: 10:55 PM
 */

namespace App\Domain\UserTemplate\Repository;

use PDO;
use DomainException;

final class UserTemplateCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insertUserTemplate(int $userId, int $templateId): int
    {
        $params = [
            "userId" => $userId,
            "templateId" => $templateId
        ];

        $sql = "INSERT INTO tbl_user_templates 
                       SET user_id = :userId,
                           template_id = :templateId;";

        $this->connection->prepare($sql)->execute($params);

        return (int)$this->connection->lastInsertId();
    }

    public function findUserById(int $userId): bool
    {
        $params = [
            'userId' => $userId
        ];

        $sql = "SELECT * FROM tbl_users WHERE user_id=:userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        return $row ? true : false;
    }

    public function getTemplateById(int $templateId): bool
    {
        $params = [
            'templateId' => $templateId
        ];

        $sql = "SELECT * FROM tbl_templates WHERE template_id=:templateId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        return $row ? true : false;
    }

    public function findUserTemplateByTemplateId(int $userId, int $templateId): bool
    {
        $params = [
            "userId" => $userId,
            "templateId" => $templateId
        ];

        $sql = "SELECT * FROM tbl_user_templates WHERE user_id = :userId AND template_id = :templateId ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        return $row ? true : false;
    }
}