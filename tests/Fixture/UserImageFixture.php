<?php


namespace App\Test\Fixture;


class UserImageFixture
{
    public $table = 'tbl_user_images';

    public $records = [
       [
           'uimg_id' => 1,
           'logo' => 'user-logo-1.jpg',
           'banner' => 'banner-logo-1.png',
           'user_id' => 1,
           'created_at' => '2020-09-17 12:00:00',
           'updated_at' => '2020-09-17 18:00:00'
       ]
    ];
}