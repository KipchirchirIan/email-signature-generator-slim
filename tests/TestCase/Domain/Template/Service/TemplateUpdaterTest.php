<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/10/20
 * Time: 3:04 AM
 */

namespace App\Test\TestCase\Domain\Template\Service;

use App\Domain\Template\Data\TemplateCreatorData;
use App\Domain\Template\Repository\TemplateUpdaterRepository;
use App\Domain\Template\Service\TemplateUpdater;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateUpdaterTest extends TestCase
{
    use AppTestTrait;

    public function testEditTemplate()
    {
        // Mock the required repository
        $this->mock(TemplateUpdaterRepository::class)
            ->method('updateTemplateById')
            ->willReturn(true);

        $service = $this->container->get(TemplateUpdater::class);
        $template = [
            'template_name' => 'Template 1',
            'template_desc' => 'Template 1',
            'template_filename' => 'template_one.html',
        ];

        $actual = $service->editTemplate(new TemplateCreatorData($template), 1);

        $this->assertSame(true, $actual);
    }
}
