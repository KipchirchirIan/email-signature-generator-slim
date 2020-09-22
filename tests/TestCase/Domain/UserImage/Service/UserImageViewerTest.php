<?php

namespace App\Test\TestCase\Domain\UserImage\Service;

use App\Domain\UserImage\Repository\UserImageViewerRepository;
use App\Domain\UserImage\Service\UserImageViewer;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserImageViewerTest extends TestCase
{
    use AppTestTrait;

    public function testGetUserImageViewData()
    {
        // Mock the required repository
        $this->mock(UserImageViewerRepository::class)
            ->method('getUserImageByUserId')
            ->willReturn(
                [
                    'uimg_id' => '1',
                    'logo' => 'user-logo-1.jpg',
                    'banner' => 'banner-logo-1.png',
                    'user_id' => '1',
                    'created_at' => '2020-09-17 12:00:00',
                    'updated_at' => '2020-09-17 18:00:00'
                ]
            );

        $service = $this->container->get(UserImageViewer::class);

        $actual = $service->getUserImageViewData(1);

        $this->assertIsArray($actual);
        $this->assertSame(
            [
                'uimg_id' => '1',
                'logo' => 'user-logo-1.jpg',
                'banner' => 'banner-logo-1.png',
                'user_id' => '1',
                'created_at' => '2020-09-17 12:00:00',
                'updated_at' => '2020-09-17 18:00:00'
            ],
            $actual
        );
    }
}
