<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/15/20
 * Time: 9:42 AM
 */

namespace App\Domain\Template\Repository;


use App\Domain\Template\Data\TemplateCreatorData;
use PDO;

/**
 * Class TemplateCreatorRepository
 * @package App\Domain\Template\Repository
 */
final class TemplateCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insertTemplate(TemplateCreatorData $template): int
    {
        $row = [
            'name' => $template->name,
            'description' => $template->description,
            'filename' => $template->filename
        ];

        $sql = "INSERT INTO tbl_templates SET ";
        $sql .= "template_name=:name, ";
        $sql .= "template_desc=:description, ";
        $sql .= "template_filename=:filename;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}