<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/27/20
 * Time: 5:50 PM
 */

namespace App\Domain\Template\Repository;


use App\Domain\Template\Data\TemplateCreatorData;
use PDO;

class TemplateUpdaterRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * TemplateUpdaterRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param TemplateCreatorData $template The template
     * @param int $templateId The template id
     *
     * @return bool success or fail
     */
    public function updateTemplateById(TemplateCreatorData $template, int $templateId): bool
    {
        $row = [
            'name' => $template->name,
            'description' => $template->description,
            'filename' => $template->filename,
            'id' => $templateId
        ];

        $sql = "UPDATE tbl_templates SET 
                         template_name=:name,
                         template_desc=:description,
                         template_filename=:filename
                         WHERE template_id=:id";

        return $this->connection->prepare($sql)->execute($row);
    }
}