<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/1/20
 * Time: 12:37 PM
 */

namespace App\Test\Fixture;


class TemplateFixture
{
    public $table = 'tbl_templates';

    public $records = [
        [
            'template_id' => 1,
            'template_name' => 'Template One',
            'template_desc' => 'This is template one',
            'template_filename' => 'template_1.html',
            'created_at' => '2020-09-01 10:00:00',
            'updated_at' => '2020-09-01 18:00:00'
        ],
        [
            'template_id' => 2,
            'template_name' => 'Template Two',
            'template_desc' => 'This is template two',
            'template_filename' => 'template_1.html',
            'created_at' => '2020-09-09 10:00:00',
            'updated_at' => '2020-09-18 18:00:00'
        ]
    ];
}