<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserSocial extends AbstractMigration
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
        $usersocial = $this->table('tbl_user_socials', [
            'id' => false,
            'primary_key' => ['usocial_id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'comment' => ''
        ]);

        $usersocial->addColumn('usocial_id', 'integer', [
            'null' => false,
            'identity' => 'enable',
        ])
            ->addColumn('user_id', 'integer', [
                'null' => false,
                'after' => 'usocial_id',
            ])
            ->addColumn('social_id', 'integer', [
                'null' => false,
                'after' => 'usocial_id',
            ])
            ->addColumn('profile_username', 'string', [
                'null' => true,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'social_id'
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'after' => 'profile_username',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'after' => 'created_at',
            ])
            ->addIndex(['user_id', 'social_id', 'profile_username'])
            ->addForeignKey('user_id', 'tbl_users', 'user_id', [
                'update' => 'NO_ACTION',
                'delete' => 'NO_ACTION',
            ])
            ->addForeignKey('social_id', 'tbl_socials', 'social_id', [
                'update' => 'NO_ACTION',
                'delete' => 'NO_ACTION',
            ])
            ->create();
    }
}
