<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/19/20
 * Time: 3:17 AM
 */

namespace App\Domain\Social\Repository;

use App\Domain\Social\Data\SocialCreatorData;
use PDO;
final class SocialCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insertSocial(SocialCreatorData $socialData): int
    {
        $params = [
            'name' => $socialData->social_name,
            'link' => $socialData->social_link,
            'profile_link' => $socialData->profile_link,
            'description' => $socialData->social_description
        ];

        $sql = "INSERT INTO tbl_socials 
                                SET social_name = :name,
                                social_link = :link,
                                social_profile_link = :profile_link,
                                social_desc = :description";

        $this->connection->prepare($sql)->execute($params);

        return $this->connection->lastInsertId();
    }
}