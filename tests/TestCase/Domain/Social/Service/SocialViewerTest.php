<?php

namespace App\Test\TestCase\Domain\Social\Service;

use App\Domain\Social\Data\SocialViewData;
use App\Domain\Social\Repository\SocialViewerRepository;
use App\Domain\Social\Service\SocialViewer;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class SocialViewerTest extends TestCase
{
    use AppTestTrait;

    public function testGetSocialViewData()
    {
        // Mock the required repository
        $this->mock(SocialViewerRepository::class)
            ->method('getSocialById')
            ->willReturn(array());

        $service = $this->container->get(SocialViewer::class);

        $actual = $service->getSocialViewData(2);

        $this->assertInstanceOf(SocialViewData::class, $actual);
    }
}
