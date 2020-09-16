<?php


use Phinx\Seed\AbstractSeed;

class TemplateSeeder extends AbstractSeed
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
                'template_name' => 'Template One',
                'template_desc' => 'This is template 1',
                'template_filename' => 'template-1.html'
            ],
            [
                'template_name' => 'Template Two',
                'template_desc' => 'This is template 2',
                'template_filename' => 'template_2.html'
            ]
        ];

        $templates = $this->table('tbl_templates');
        $templates->insert($data)->saveData();


        // Clear all data
//        $this->execute('SET FOREIGN_KEY_CHECKS=0;');
//        $templates->truncate();
//        $this->execute('SET FOREIGN_KEY_CHECKS=1;');
    }
}
