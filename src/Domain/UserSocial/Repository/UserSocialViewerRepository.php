<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 1:10 PM
 */

namespace App\Domain\UserSocial\Repository;


use App\Domain\UserSocial\Data\UserSocialCreatorData;
use DomainException;
use PDO;

final class UserSocialViewerRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * UserSocialViewerRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get a list of user's social media accounts
     *
     * @param int $userId The user ID
     *
     * @return array List of user's social media accounts
     */
    public function findAllUserSocialsById(int $userId): array
    {
        $params = [
            'userId'=> $userId
        ];

        $sql = "SELECT * FROM tbl_user_socials WHERE user_id = :userId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();

        if (!$rows) {
            throw new DomainException('User\'s social accounts not found');
        }

        foreach ($rows as $row) {
            $userSocialData[] = new UserSocialCreatorData($row);
        }

        return $userSocialData;
    }

}