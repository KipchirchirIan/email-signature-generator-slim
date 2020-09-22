<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/10/20
 * Time: 2:29 AM
 */

namespace App\Test\TestCase\Domain\Template\Service;

use App\Domain\Template\Repository\TemplateViewerRepository;
use App\Domain\Template\Service\TemplateListData;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateListDataTest extends TestCase
{
    use AppTestTrait;

    public function testListAllTemplates()
    {
        $this->mock(TemplateViewerRepository::class)
            ->method('findAllTemplates')
            ->willReturn(
                array(
                    'template_id' => '1',
                    'template_name' => 'Template One',
                    'template_desc' => 'This is template one',
                    'template_filename' => 'template_1.html',
                    'created_at' => '2020-09-01 10:00:00',
                    'updated_at' => '2020-09-01 18:00:00'
                )
            );

        $service = $this->container->get(TemplateListData::class);

        $actual = $service->listAllTemplates();

        $this->assertIsArray($actual);
        $this->assertArrayHasKey('template_id', $actual);
        $this->assertArrayHasKey('template_name', $actual);
        $this->assertArrayHasKey('template_filename', $actual);
    }
}
