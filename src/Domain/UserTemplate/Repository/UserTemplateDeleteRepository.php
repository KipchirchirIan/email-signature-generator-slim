<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/7/20
 * Time: 4:28 AM
 */

namespace App\Domain\UserTemplate\Repository;

use PDO;

final class UserTemplateDeleteRepository
{
    /**
     * @var PDO The connections
     */
    private $connection;

    /**
     * UserTemplateDeleteRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $userId The User ID
     * @param int $userTemplateId The Template ID
     *
     * @return bool <b>TRUE</b> if 1 or more rows deleted<br>
     * <b>FALSE</b> if failed or 0 rows deleted.
     */
    public function deleteUserTemplate(int $userId, int $userTemplateId): bool
    {
        $params = [
            'userTemplateId' => $userTemplateId,
            'userId' => $userId
        ];

        $sql = "DELETE FROM tbl_user_templates WHERE utpl_id = :userTemplateId AND user_id = :userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        $numRows = $stmt->rowCount();

        return $numRows;
    }

    /**
     * @param int $userId The User ID
     *
     * @return bool <b>TRUE</b> if 1 or more rows deleted<br>
     * <b>FALSE</b> if failed or 0 rows deleted.
     */
    public function deleteAllUserTemplatesByUserId(int $userId): bool
    {
        $params = [
            'userId' => $userId
        ];

        $sql = "DELETE FROM tbl_user_templates WHERE user_id = :userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        $numRows = $stmt->rowCount();

        return $numRows;
    }
}