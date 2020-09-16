<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class User extends AbstractMigration
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
        $users = $this->table('tbl_users', [
            'id' => false,
            'primary_key' => ['user_id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'comment' => ''
        ]);

        $users->addColumn('user_id', 'integer', [
            'null' => false,
            'identity' => 'enable'
        ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'user_id',
            ])
            ->addColumn('company', 'string', [
                'null' => true,
                'limit' => 255,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'name',
            ])
            ->addColumn('position', 'string', [
                'null' => true,
                'limit' => 255,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'company',
            ])
            ->addColumn('department', 'string', [
                'null' => true,
                'limit' => 255,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'position',
            ])
            ->addColumn('phone', 'string', [
                'null' => true,
                'limit' => 50,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'department',
            ])
            ->addColumn('mobile', 'string', [
                'null' => true,
                'limit' => 50,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'phone',
            ])
            ->addColumn('website', 'string', [
                'null' => true,
                'limit' => 255,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'mobile',
            ])
            ->addColumn('skype', 'string', [
                'null' => true,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'website',
            ])
            ->addColumn('address', 'string', [
                'null' => true,
                'limit' => 255,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'skype',
            ])
            ->addColumn('email', 'string', [
                'null' => false,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'address',
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
                'name' => 'idx_users_email'
            ])
            ->create();
    }



}
