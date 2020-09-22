<?php

namespace App\Test\TestCase\Domain\UserImage\Service;

use App\Domain\UserImage\Data\UserImageUpdaterData;
use App\Domain\UserImage\Repository\UserImageUpdaterRepository;
use App\Domain\UserImage\Service\UserImageUpdater;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserImageUpdaterTest extends TestCase
{
    use AppTestTrait;

    public function testEditUserImage()
    {
        // Mock the required repository
        $this->mock(UserImageUpdaterRepository::class)
            ->method('updateUserImage')
            ->willReturn(true);

        $service = $this->container->get(UserImageUpdater::class);

        $userImage = new UserImageUpdaterData([
            'logo' => 'user-logo-1.jpg',
            'banner' => 'banner-logo-1.png',
        ]);

        $actual = $service->editUserImage($userImage, 1);

        $this->assertSame(true, $actual);
    }
}
