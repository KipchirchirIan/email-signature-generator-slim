<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/9/20
 * Time: 10:10 AM
 */

namespace App\Test\TestCase\Domain\Template\Repository;

use App\Domain\Template\Repository\TemplateViewerRepository;
use App\Test\Fixture\TemplateFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateViewerRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    public $fixtures = [
        TemplateFixture::class,
    ];

    public function createInstance()
    {
        return $this->container->get(TemplateViewerRepository::class);
    }

    public function testGetTemplateById()
    {
        $repository = $this->createInstance();

        $expected = [
            'template_id' => '1',
            'template_name' => 'Template One',
            'template_desc' => 'This is template one',
            'template_filename' => 'template_1.html',
            'created_at' => '2020-09-01 10:00:00',
            'updated_at' => '2020-09-01 18:00:00'
        ];

        $actual = $repository->getTemplateById(1);

        $this->assertSame($expected, $actual);
    }
}
