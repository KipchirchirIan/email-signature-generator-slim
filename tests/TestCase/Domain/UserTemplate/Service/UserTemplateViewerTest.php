<?php

namespace App\Test\TestCase\Domain\UserTemplate\Service;

use App\Domain\UserTemplate\Repository\UserTemplateViewerRepository;
use App\Domain\UserTemplate\Service\UserTemplateViewer;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserTemplateViewerTest extends TestCase
{
    use AppTestTrait;

    public function testGetUserTemplateData()
    {
        $this->mock(UserTemplateViewerRepository::class)
            ->method('findAllUserTemplateByUserId')
            ->willReturn([]);

        $service = $this->container->get(UserTemplateViewer::class);

        $actual = $service->getUserTemplateData(1);

        $this->assertIsArray($actual);
    }
}
