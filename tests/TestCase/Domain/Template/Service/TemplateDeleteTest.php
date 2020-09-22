<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/10/20
 * Time: 2:18 AM
 */

namespace App\Test\TestCase\Domain\Template\Service;

use App\Domain\Template\Repository\TemplateDeleteRepository;
use App\Domain\Template\Service\TemplateDelete;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateDeleteTest extends TestCase
{
    use AppTestTrait;

    public function testDeleteTemplateData()
    {
        $this->mock(TemplateDeleteRepository::class)
            ->method('deleteTemplateById')
            ->willReturn(1);

        $service = $this->container->get(TemplateDelete::class);

        $actual = $service->deleteTemplateData(2);

        $this->assertSame(true, $actual);
    }
}
