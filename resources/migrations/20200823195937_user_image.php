<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserImage extends AbstractMigration
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
        $userimages = $this->table('tbl_user_images', [
            'id' => false,
            'primary_key' => ['uimg_id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'comment' => ''
        ]);

        $userimages->addColumn('uimg_id', 'integer', [
            'null' => false,
            'identity' => 'enable',
        ])
            ->addColumn('logo', 'string', [
                'null' => true,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'uimg_id'
            ])
            ->addColumn('banner', 'string', [
                'null' => true,
                'limit' => 100,
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'after' => 'logo'
            ])
            ->addColumn('user_id', 'integer', [
                'null' => false,
                'after' => 'banner',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'after' => 'user_id',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'after' => 'created_at',
            ]);

        $userimages->addIndex('user_id');

        $userimages->addForeignKey('user_id', 'tbl_users', 'user_id', [
            'delete' => 'NO_ACTION',
            'update' => 'NO_ACTION'
        ]);

        $userimages->create();
    }
}
