<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/9/20
 * Time: 4:45 PM
 */

namespace App\Test\TestCase\Domain\Template\Service;

use App\Domain\Template\Data\TemplateCreatorData;
use App\Domain\Template\Repository\TemplateCreatorRepository;
use App\Domain\Template\Service\TemplateCreator;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateCreatorTest extends TestCase
{
    use AppTestTrait;

    public function testCreateTemplate()
    {
        $this->mock(TemplateCreatorRepository::class)
            ->method('insertTemplate')
            ->willReturn(1);

        $service = $this->container->get(TemplateCreator::class);

        $template = [
            'template_name' => 'Template One',
            'template_desc' => 'This is template one',
            'template_filename' => 'template_1.html',
        ];

        $actual = $service->createTemplate(new TemplateCreatorData($template));

        $this->assertSame(1, $actual);
    }
}
