<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Socials extends AbstractMigration
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
        $socials = $this->table('tbl_socials', [
            'id' => false,
            'primary_key' => ['social_id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'comment' => ''
        ]);

        $socials->addColumn('social_id', 'integer', [
            'null' => false,
            'identity' => 'enable'
        ])
            ->addColumn('social_name', 'string', [
                'null' => false,
                'limit' => 50,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'social_id'
            ])
            ->addColumn('social_link', 'string', [
                'null' => false,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'social_name'
            ])
            ->addColumn('social_profile_link', 'string', [
                'null' => false,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'social_link'
            ])
            ->addColumn('social_desc', 'string', [
                'null' => false,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'social_profile_link'
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'after' => 'social_desc',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'after' => 'created_at',
            ])
            ->create();
    }
}
