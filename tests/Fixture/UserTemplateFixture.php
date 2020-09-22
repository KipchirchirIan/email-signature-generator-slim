<?php


namespace App\Test\Fixture;


class UserTemplateFixture
{
    /**
     * @var string Table name
     */
    public $table = 'tbl_user_templates';

    /**
     * @var array Records
     */
    public $records = [
        [
            'utpl_id' => 1,
            'user_id' => 1,
            'template_id' => 1,
            'created_at' => '2020-09-22 07:23:15',
            'updated_at' => '2020-09-22 08:33:02'
        ],
        [
            'utpl_id' => 2,
            'user_id' => 2,
            'template_id' => 1,
            'created_at' => '2020-09-22 08:23:41',
            'updated_at' => '2020-09-22 08:40:28'
        ]
    ];
}