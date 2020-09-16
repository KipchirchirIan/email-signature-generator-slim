<?php


use Phinx\Seed\AbstractSeed;

class SuperUserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'nickname' => 'test',
                'email' => 'test@cmshosting.xyz',
                'password' => password_hash('cmshosting.xyz', PASSWORD_DEFAULT),
            ],
        ];

        $superusers = $this->table('tbl_superusers');
        $superusers->insert($data)->saveData();

        // Clear all data
//        $this->execute('SET FOREIGN_KEY_CHECKS=0;');
//        $users->truncate();
//        $this->execute('SET FOREIGN_KEY_CHECKS=1;');
    }
}
