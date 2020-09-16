<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddTemplateFilenameFieldToTemplates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $templates = $this->table('tbl_templates');

        $templates->addColumn('template_filename', 'string', [
            'null' => false,
            'limit' => 50,
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'after' => 'template_desc',
        ])
            ->update();
    }
}
