<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/21/20
 * Time: 12:44 AM
 */

namespace App\Domain\Social\Repository;


use DomainException;
use PDO;

final class SocialDeleteRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * SocialDeleteRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Delete social media platform by id
     *
     * @param int $socialId The social ID
     *
     * @return bool <b>TRUE</b> if one or more rows is deleted<br>
     * <b>FALSE</b> if zero rows are deleted
     */
    public function deleteSocialById(int $socialId): bool
    {
        $params = [
            'socialId' => $socialId
        ];

        if (!$this->socialExists($socialId)) {
            throw new DomainException(sprintf('Social media not found: %s', $socialId));
        }

        $sql = "DELETE FROM tbl_socials WHERE social_id = :socialId LIMIT 1";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        return $stmt->rowCount();
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