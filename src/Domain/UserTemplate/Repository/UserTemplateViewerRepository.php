<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 6/12/20
 * Time: 11:22 PM
 */

namespace App\Domain\UserTemplate\Repository;

use PDO;

class UserTemplateViewerRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * UserTemplateViewerRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $userId The User ID
     *
     * @return array List of templates
     */
    public function findAllUserTemplateByUserId(int $userId): array
    {
        $params = [
            "userId" => $userId
        ];

        $sql = "SELECT * FROM tbl_user_templates WHERE user_id = :userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();

        return $rows;
    }
}