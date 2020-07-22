<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/22/20
 * Time: 6:25 AM
 */

namespace App\Domain\UserSocial\Repository;


use App\Domain\UserSocial\Data\UserSocialUpdaterData;
use PDO;

final class UserSocialUpdaterRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * UserSocialUpdaterRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Update user's social media profile username
     *
     * @param UserSocialUpdaterData $userSocial The user's social media profile details
     * @param int $userId The User ID
     *
     * @return bool <b>TRUE</b> if one or more rows is updated<br>
     * <b>FALSE</b> if zero rows are updated
     */
    public function updateUserSocials(UserSocialUpdaterData $userSocial, int $userId): bool
    {
        $params = [
            'socialId' => $userSocial->socialId,
            'profileUsername' => $userSocial->profileUsername,
            'userId' => $userId
        ];

        $sql = "UPDATE tbl_user_socials
                            SET profile_username = :profileUsername
                            WHERE user_id = :userId
                            AND social_id = :socialId
                            LIMIT 1";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        $affectedRows = $stmt->rowCount();

        return $affectedRows;
    }
}