<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/8/20
 * Time: 1:55 AM
 */

namespace App\Domain\UserImage\Repository;

use App\Domain\UserImage\Data\UserImageCreatorData;
use PDO;
use DomainException;

class UserImageCreatorRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * UserImageCreatorRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $userId The User ID
     * @param UserImageCreatorData $userImage The user image
     *
     * @return int The new ID
     */
    public function insertUserImage(int $userId, UserImageCreatorData $userImage): int
    {
        $row = [
            'logo' => $userImage->logo,
            'banner' => $userImage->banner,
            'userId' => $userId
        ];

        $sql = "INSERT INTO tbl_user_images SET
                                logo = :logo,
                                banner = :banner,
                                user_id = :userId;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
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

        $sql = "SELECT * FROM tbl_users WHERE user_id=:userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        return $row ? true : false;
    }
}