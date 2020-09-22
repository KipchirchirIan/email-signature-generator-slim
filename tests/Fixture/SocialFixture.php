<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/10/20
 * Time: 10:57 AM
 */

namespace App\Test\Fixture;


class SocialFixture
{
    public $table = 'tbl_socials';

    public $records =  [
        [
            'social_id' => 1,
            'social_name' => 'Facebook',
            'social_link' => 'https://www.facebook.com/',
            'social_profile_link' => 'https://www.facebook.com/',
            'social_desc' => 'Facebook',
            'created_at' => '2020-08-01 08:00:00',
            'updated_at' => '2020-08-01 15:00:00'
        ],
        [
            'social_id' => 2,
            'social_name' => 'GitHub',
            'social_link' => 'https://www.github.com/',
            'social_profile_link' => 'https://www.github.com/',
            'social_desc' => 'Social network for devs',
            'created_at' => '2020-08-01 09:00:00',
            'updated_at' => '2020-08-01 15:00:00'
        ]
    ];
}