<?php


namespace App\Test\Fixture;


class UserSocialFixture
{
    public $table = 'tbl_user_socials';

    public $records = [
        [
            'usocial_id' => 1,
            'user_id' => 1,
            'social_id' => 1,
            'profile_username' => 'johndoe',
            'created_at' => '2020-09-21 08:20:00',
            'updated_at' => '2020-09-30 08:20:00',
        ],
        [
            'usocial_id' => 2,
            'user_id' => 1,
            'social_id' => 2,
            'profile_username' => 'dev_johndoe',
            'created_at' => '2020-09-21 09:00:00',
            'updated_at' => '2020-09-30 09:20:00',
        ]
    ];
}