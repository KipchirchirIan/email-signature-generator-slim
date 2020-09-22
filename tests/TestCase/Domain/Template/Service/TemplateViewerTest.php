<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/10/20
 * Time: 10:10 AM
 */

namespace App\Test\TestCase\Domain\Template\Service;

use App\Domain\Template\Repository\TemplateViewerRepository;
use App\Domain\Template\Service\TemplateViewer;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateViewerTest extends TestCase
{
    use AppTestTrait;

    public function testGetTemplateViewData()
    {
        // Mock the required repository
        $this->mock(TemplateViewerRepository::class)
            ->method('getTemplateById')
            ->willReturn(
                [
                    'template_id' => '1',
                    'template_name' => 'Template One',
                    'template_desc' => 'This is template one',
                    'template_filename' => 'template_1.html',
                    'created_at' => '2020-09-01 10:00:00',
                    'updated_at' => '2020-09-01 18:00:00'
                ]
            );

        $service = $this->container->get(TemplateViewer::class);

        $actual = $service->getTemplateViewData(1);

        $this->assertSame(
            [
                'template_id' => '1',
                'template_name' => 'Template One',
                'template_desc' => 'This is template one',
                'template_filename' => 'template_1.html',
                'created_at' => '2020-09-01 10:00:00',
                'updated_at' => '2020-09-01 18:00:00'
            ],
            $actual
        );

        $this->assertIsArray($actual);
        $this->assertArrayHasKey('template_id', $actual);
        $this->assertArrayHasKey('template_name', $actual);
        $this->assertArrayHasKey('template_filename', $actual);
    }
}
