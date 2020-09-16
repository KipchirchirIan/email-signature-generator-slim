<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
                'name' => 'John Doe',
                'company' => 'John Doe & Sons',
                'position' => 'CEO & Founder',
                'department' => 'Board of Directors',
                'phone' => '0721000111',
                'mobile' => '0721000111',
                'website' => 'www.johndoe.com',
                'skype' => 'john.doe',
                'email' => 'johndoe@mail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'address' => 'John Doe Avenue'
            ],
            [
                'name' => 'Jane Doe',
                'company' => 'Jane Doe Corporation',
                'position' => 'CTO',
                'department' => 'Board of Directors',
                'phone' => '0721000111',
                'mobile' => '0721000111',
                'website' => 'www.janedoe.co.uk',
                'skype' => 'janedoe',
                'email' => 'jdoe@mail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'address' => 'Jane Doe Lane'
            ]
        ];

        $users = $this->table('tbl_users');
        $users->insert($data)->saveData();



        // Clear all data
//        $this->execute('SET FOREIGN_KEY_CHECKS=0;');
//        $users->truncate();
//        $this->execute('SET FOREIGN_KEY_CHECKS=1;');
    }
}
