<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/21/20
 * Time: 9:46 PM
 */

namespace App\Domain\Template\Repository;

use PDO;

/**
 * Class TemplateDeleteRepository
 * @package App\Domain\Template\Repository
 */
class TemplateDeleteRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * TemplateDeleteRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $templateId The template
     *
     * @return int Number of rows
     */
    public function deleteTemplateById(int $templateId): int
    {
        $params = [
            'templateId' => $templateId
        ];

        $sql = "DELETE FROM tbl_templates WHERE template_id=:templateId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        $numRows = $stmt->rowCount();

        return $numRows;
    }
}