<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/30/20
 * Time: 6:04 PM
 */

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreatorData;
use PDO;
use DomainException;

final class UserViewerRepository
{
    /**
     * @var PDO The connection
     */
    private $connection;

    /**
     * UserViewerRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get user by Id
     *
     * @param int $userId The user id
     *
     * @return array The user row
     */
    public function getUserById(int $userId): array
    {
        $params = [
            'userId' => $userId
        ];

        $sql = "SELECT * FROM tbl_users WHERE user_id=:userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        if (!$row) {
            throw new DomainException(sprintf('User not found: %d', $userId));
        }

        return $row;
    }

    /**
     * Find all users
     *
     * @return UserCreatorData[] A list of users
     */
    public function findAllUsers(): array
    {
        $sql = "SELECT * FROM tbl_users ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $result = [];

        foreach ($rows as $row) {
            $result = new UserCreatorData($row);
        }

        return $result;
    }
}