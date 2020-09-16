<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserTemplates extends AbstractMigration
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
        $usertpl = $this->table('tbl_user_templates', [
            'id' => false,
            'primary_key' => ['utpl_id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'comment' => ''
        ]);

        $usertpl->addColumn('utpl_id', 'integer', [
            'null' => false,
            'identity' => 'enable',
        ])
            ->addColumn('user_id', 'integer', [
                'null' => false,
                'after' => 'utpl_id',
            ])
            ->addColumn('template_id', 'integer', [
                'null' => false,
                'after' => 'user_id',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'after' => 'template_id',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'after' => 'created_at',
            ])
            ->addIndex(['user_id'], ['name' => 'idx_user_id'])
            ->addIndex(['template_id'], ['name' => 'idx_template_id'])
            ->addForeignKey('user_id', 'tbl_users', 'user_id', [
                'delete' => 'NO_ACTION',
                'update' => 'NO_ACTION'
            ])
            ->addForeignKey('template_id', 'tbl_templates', 'template_id', [
                'delete' => 'NO_ACTION',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}
