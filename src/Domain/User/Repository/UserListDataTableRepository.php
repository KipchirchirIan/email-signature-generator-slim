<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/29/20
 * Time: 2:02 PM
 */

namespace App\Domain\User\Repository;

use PDO;

/**
 * Class UserListDataTableRepository
 *
 * @package App\Domain\User\Repository
 */
class UserListDataTableRepository
{
    /**
     * @var PDO The connection
     */
    private $connection;

    /**
     * UserListDataTableRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array The result set
     */
    public function getTableData(): array
    {
        $sql = "SELECT * FROM tbl_users ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}