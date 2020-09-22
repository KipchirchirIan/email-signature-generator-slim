<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/20/20
 * Time: 9:44 AM
 */

namespace App\Test\Fixture;


class UserFixture
{
    public $table = 'tbl_users';

    public $records = [
        [
            'user_id' => 1,
            'name' => 'John Doe',
            'email' => 'johndoe@mail.com',
            'password' => '$2y$10$HewrEzWqSQh20gZqKufaCOw0hEW7hVwmIT/AfejznU0OgJQ13.nl2',
            'company' => 'John Doe & Sons',
            'position' => 'CEO & Founder',
            'department' => 'Board of Directors',
            'phone' => '0721000111',
            'mobile' => '0721000111',
            'website' => 'www.johndoe.com',
            'skype' => null,
            'address' => 'John Doe Avenue',
            'created_at' => '2020-08-01 12:00:00',
            'updated_at' => '2020-08-01 18:00:00'
        ],
        [
            'user_id' => 2,
            'name' => 'Jane Doe',
            'email' => 'janedoe@mail.com',
            'password' => '$2y$10$fp2k5zk.G1nSYMCEYeXLluUnHKPv9V4rc2BjiuD8FCKD/sbhjw9mG',
            'company' => 'Jane Doe Inc.',
            'position' => 'Owner',
            'department' => 'Board of Directors',
            'phone' => '0721000222',
            'mobile' => '0721000222',
            'website' => null,
            'skype' => null,
            'address' => 'Jane Doe Lane',
            'created_at' => '2020-08-01 12:00:00',
            'updated_at' => '2020-08-01 18:00:00'
        ]
    ];
}