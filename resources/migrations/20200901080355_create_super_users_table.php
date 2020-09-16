<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSuperUsersTable extends AbstractMigration
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
        $superusers = $this->table('tbl_superusers', [
            'id' => false,
            'primary_key' => ['suid'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'comment' => ''
        ]);

        $superusers->addColumn('suid', 'integer', [
            'null' => false,
            'identity' => 'enable',
        ])
            ->addColumn('first_name', 'string', [
                'null' => false,
                'limit' => 50,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'suid',
            ])
            ->addColumn('last_name', 'string', [
                'null' => false,
                'limit' => 50,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'first_name',
            ])
            ->addColumn('nickname', 'string', [
                'null' => true,
                'limit' => 50,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'last_name',
            ])
            ->addColumn('email', 'string', [
                'null' => false,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'nick_name',
            ])
            ->addColumn('password', 'string', [
                'null' => false,
                'limit' => 255,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'email',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'after' => 'password',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'after' => 'created_at',
            ])
            ->addIndex('email', [
                'unique' => true,
                'name' => 'idx_su_email'
            ])
            ->create();
    }
}
