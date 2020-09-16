<?php


use Phinx\Seed\AbstractSeed;

class UserImageSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return ['UserSeeder'];
    }

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
                'logo' => 'user-logo-1.jpg',
                'banner' => 'banner-logo-1.png',
                'user_id' => 1
            ],
            [
                'logo' => 'logo-user-2.jpg',
                'banner' => 'banner-logo-2.png',
                'user_id' => 2
            ]
        ];

        $userimages = $this->table('tbl_user_images');
        $userimages->insert($data)->saveData();

//         Clear table
//        $userimages->truncate();
    }
}
