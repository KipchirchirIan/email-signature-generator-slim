<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/7/20
 * Time: 8:56 AM
 */

namespace App\Domain\User\Repository;

use PDO;

/**
 * Class UserDeleteRepository
 * @package App\Domain\User\Repository
 */
final class UserDeleteRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * UserDeleteRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $userId The user id
     *
     * @return int Number of rows affected
     */
    public function deleteUserById(int $userId): int
    {
        $params = [
          'userId' => $userId
        ];

        $sql = "DELETE FROM tbl_users WHERE user_id=:userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        $result = $stmt->rowCount();

        return $result;
    }
}