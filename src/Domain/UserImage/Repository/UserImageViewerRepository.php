<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/11/20
 * Time: 4:10 AM
 */

namespace App\Domain\UserImage\Repository;

use PDO;
use DomainException;
class UserImageViewerRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getUserImageByUserId(int $userId): array
    {
        $params = [
            'userId' => $userId
        ];

        if (!$this->userExists($userId)) {
            throw new DomainException(sprintf('User not found: %d', $userId));
        }

        $sql = "SELECT * FROM tbl_user_images WHERE user_id = :userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        if (!$row) {
            throw new DomainException('Image resources for user not found');
        }

        return $row;
    }

    /**
     * Get user by Id
     *
     * @param int $userId The user id
     *
     * @return bool <b>TRUE</b> if user exists,<br>
     * <b>FALSE</b> if user doesn't exist
     */
    public function userExists(int $userId): bool
    {
        $params = [
            'userId' => $userId
        ];

        $sql = "SELECT * FROM tbl_users WHERE user_id = :userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        return $row ? true : false;
    }
}