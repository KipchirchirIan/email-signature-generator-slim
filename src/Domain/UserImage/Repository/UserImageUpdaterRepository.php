<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/18/20
 * Time: 5:48 AM
 */

namespace App\Domain\UserImage\Repository;

use App\Domain\UserImage\Data\UserImageCreatorData;
use App\Domain\UserImage\Data\UserImageUpdaterData;
use DomainException;
use PDO;

class UserImageUpdaterRepository
{
    /**
     * @var PDO The connection
     */
    private $connection;

    /**
     * UserImageUpdaterRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param UserImageUpdaterData $userImageData The user image data
     * @param int $userId The user ID
     *
     * @return bool <b>FALSE</b> if zero rows affected<br>
     * <b>TRUE</b> if one or more rows affected
     */
    public function updateUserImage(UserImageUpdaterData $userImageData, int $userId): bool
    {
        $row = [
            'logo' => $userImageData->logo,
            'banner' => $userImageData->banner,
            'userId' => $userId
        ];

        if (!$this->userExists($userId)) {
            throw new DomainException(sprintf('User not found: %d', $userId));
        }

        $sql = "UPDATE tbl_user_images
                        SET logo = :logo,
                        banner = :banner
                        WHERE user_id = :userId
                        LIMIT 1";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($row);

        $affectedRows = $stmt->rowCount();

        return $affectedRows;
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