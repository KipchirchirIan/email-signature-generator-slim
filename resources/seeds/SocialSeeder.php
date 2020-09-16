<?php


use Phinx\Seed\AbstractSeed;

class SocialSeeder extends AbstractSeed
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
                'social_name' => 'Facebook',
                'social_link' => 'https://www.facebook.com/',
                'social_profile_link' => 'https://www.facebook.com/',
                'social_desc' => 'Facebook',
            ],
            [
                'social_name' => 'GitHub',
                'social_link' => 'https://www.github.com/',
                'social_profile_link' => 'https://www.github.com/',
                'social_desc' => 'Social network for devs',
            ]
        ];

        $socials = $this->table('tbl_socials');
        $socials->insert($data)->saveData();

        // Truncate table
//        $this->execute('SET FOREIGN_KEY_CHECKS=0;');
//        $socials->truncate();
//        $this->execute('SET FOREIGN_KEY_CHECKS=1;');
    }

}
