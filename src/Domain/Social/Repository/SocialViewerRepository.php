<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/19/20
 * Time: 11:42 PM
 */

namespace App\Domain\Social\Repository;

use App\Domain\Social\Data\SocialCreatorData;
use DomainException;
use PDO;

final class SocialViewerRepository
{
    /**
     * @var PDO The connection
     */
    private $connection;

    /**
     * SocialViewerRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get social media by id
     *
     * @param int $socialId The social media ID
     *
     * @throws DomainException
     *
     * @return array The social media row
     */
    public function getSocialById(int $socialId): array
    {
        $params = [
            'socialId' => $socialId
        ];

        $sql = "SELECT * FROM tbl_socials WHERE social_id = :socialId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        if (!$row) {
            throw new DomainException(sprintf('Social media not found: %s', $socialId));
        }

        return $row;
    }

    /**
     * Get a list social media platforms
     *
     * @return array A list of social media platforms
     */
    public function findAllSocials(): array
    {
        $sql = "SELECT * FROM tbl_socials WHERE social_id = :socialId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach ($rows as $row) {
            $socialData[] = new SocialCreatorData($row);
        }

        return $socialData;
    }

}