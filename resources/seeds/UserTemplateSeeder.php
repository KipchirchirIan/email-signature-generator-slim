<?php


use Phinx\Seed\AbstractSeed;

class UserTemplateSeeder extends AbstractSeed
{

    public function getDependencies()
    {
        return [
            'UserSeeder',
            'TemplateSeeder'
        ];
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
                'user_id' => 1,
                'template_id' => 1
            ],
            [
                'user_id' => 2,
                'template_id' => 2
            ]
        ];

        $usertpls = $this->table('tbl_user_templates');
        $usertpls->insert($data)->saveData();

        // Clear data
//        $usertpls->truncate();
    }
}
