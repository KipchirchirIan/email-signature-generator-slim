<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/16/20
 * Time: 5:50 AM
 */

namespace App\Domain\Template\Repository;

use PDO;
use DomainException;

/**
 * Class TemplateViewerRepository
 * @package App\Domain\Template\Repository
 */
class TemplateViewerRepository
{
    /**
     * @var PDO The connection
     */
    private $connection;

    /**
     * TemplateViewerRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $templateId Id of the template
     *
     * @return array The template
     */
    public function getTemplateById(int $templateId): array
    {
        $params = [
            'templateId' => $templateId
        ];

        $sql = "SELECT * FROM tbl_templates WHERE template_id=:templateId";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();

        if (!$row) {
            throw new DomainException(sprintf("Template not found: %f", $templateId));
        }

        return $row;
    }

    /**
     * @return array List of all templates
     */
    public function findAllTemplates(): array
    {
        $sql = "SELECT * FROM tbl_templates";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

//        $result = [];
//
//        foreach ($rows as $row) {
//            $result = new TemplateCreatorData($row);
//        }

        return $rows;
    }
}