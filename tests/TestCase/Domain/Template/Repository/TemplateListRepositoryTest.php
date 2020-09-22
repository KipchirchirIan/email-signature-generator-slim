<?php

namespace App\Test\TestCase\Domain\Template\Repository;

use App\Domain\Template\Repository\TemplateViewerRepository;
use App\Test\Fixture\TemplateFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateListRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    public $fixtures = [
        TemplateFixture::class,
    ];

    public function createInstance()
    {
        return $this->container->get(TemplateViewerRepository::class);
    }

    public function testFindAllTemplates()
    {
        $repository = $this->createInstance();

        $expected = array(
            [
                'template_id' => '1',
                'template_name' => 'Template One',
                'template_desc' => 'This is template one',
                'template_filename' => 'template_1.html',
                'created_at' => '2020-09-01 10:00:00',
                'updated_at' => '2020-09-01 18:00:00'
            ],
            [
                'template_id' => '2',
                'template_name' => 'Template Two',
                'template_desc' => 'This is template two',
                'template_filename' => 'template_1.html',
                'created_at' => '2020-09-09 10:00:00',
                'updated_at' => '2020-09-18 18:00:00'
            ]
        );

        $actual = $repository->findAllTemplates();

        $this->assertSame($expected, $actual);
        $this->assertIsArray($actual);
    }
}
