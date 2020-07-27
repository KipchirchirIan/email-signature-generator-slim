<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 3:22 AM
 */

namespace App\Domain\UserSocial\Repository;


use App\Domain\UserSocial\Data\UserSocialCreatorData;
use PDO;

class UserSocialCreatorRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * UserSocialCreatorRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert profile details of user
     *
     * @param UserSocialCreatorData $userSocial The user's social media account details
     * @param int $userId The user ID
     *
     * @return int ID of last inserted record
     */
    public function insertUserSocial(UserSocialCreatorData $userSocial, int $userId): int
    {
        $params = [
            'socialId' => $userSocial->socialId,
            'username' => $userSocial->profileUsername,
            'userId' => $userId
        ];

        $sql = "INSERT INTO tbl_user_socials 
                                SET user_id = :userId,
                                social_id = :socialId,
                                profile_username = :username";

        $this->connection->prepare($sql)->execute($params);

        return $this->connection->lastInsertId();
    }
}