<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/20/20
 * Time: 4:07 AM
 */

namespace App\Domain\Social\Repository;


use App\Domain\Social\Data\SocialCreatorData;
use DomainException;
use PDO;

class SocialUpdaterRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * SocialUpdaterRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Updated social media platform by id
     *
     * @param SocialCreatorData $socialData The social media platform
     * @param int $socialId The social ID
     *
     * @return bool <b>TRUE</b> if one or more rows is updated<br>
     * <b>FALSE</b> if zero rows are updated
     */
    public function updateSocialById(SocialCreatorData $socialData, int $socialId): bool
    {
        $params = [
            'name' => $socialData->social_name,
            'hlink' => $socialData->social_link,
            'profile_link' => $socialData->profile_link,
            'desc' => $socialData->social_description,
            'socialId' => $socialId
        ];

        if (!$this->socialExists($socialId)) {
            throw new DomainException(sprintf('Social media not found: %s', $socialId));
        }

        $sql = "UPDATE tbl_socials 
                        SET social_name = :name,
                        social_link = :hlink,
                        social_profile_link = :profile_link,
                        social_desc = :desc
                        WHERE social_id = :socialId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        $affectedRows = $stmt->rowCount();

        return $affectedRows;
    }

    /**
     * Get social media by id
     *
     * @param int $socialId The social media ID
     *
     * @throws DomainException
     *
     * @return bool <b>TRUE</b> if social media exists,<br>
     * <b>FALSE</b> if social media doesn't exist
     */
    public function socialExists(int $socialId): bool
    {
        $params = [
            'socialId' => $socialId
        ];

        $sql = "SELECT * FROM tbl_socials WHERE social_id = :socialId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        return $row ? true : false;
    }
}