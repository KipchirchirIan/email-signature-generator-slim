<?php


use Phinx\Seed\AbstractSeed;

class UserSocialSeeder extends AbstractSeed
{

    public function getDependencies()
    {
        return [
            'UserSeeder',
            'SocialSeeder'
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
                'social_id' => 1,
                'profile_username' => 'fb.johndoe'
            ],
            [
                'user_id' => 2,
                'social_id' => 1,
                'profile_username' => 'janedoe'
            ],
            [
                'user_id' => 2,
                'social_id' => 2,
                'profile_username' => 'janedoe'
            ]
        ];

        $usersocial = $this->table('tbl_user_socials');
        $usersocial->insert($data)->saveData();

        // Clear table
//        $usersocial->truncate();


    }


}
