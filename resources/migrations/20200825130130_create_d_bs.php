<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateDBs extends AbstractMigration
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
//        if ($this->getEnvironment() == 'production') {
//            $this->createDatabase('emailsignaturegenerator', [
//                'engine' => 'InnoDB',
//                'collation' => 'utf8mb4_general_ci',
//            ]);
//        } elseif ($this->getEnvironment() == 'development') {
//            $this->createDatabase('emailsignaturegen_dev', [
//                'engine' => 'InnoDB',
//            ]);
//        } elseif ($this->getEnvironment() == 'testing') {
//            $this->createDatabase('emailsignaturegen_test', [
//                'engine' => 'InnoDB',
//            ]);
//        }
    }
}
