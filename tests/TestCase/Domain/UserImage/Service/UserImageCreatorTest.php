<?php

namespace App\Test\TestCase\Domain\UserImage\Service;

use App\Domain\UserImage\Data\UserImageCreatorData;
use App\Domain\UserImage\Repository\UserImageCreatorRepository;
use App\Domain\UserImage\Service\UserImageCreator;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserImageCreatorTest extends TestCase
{
    use AppTestTrait;

    public function testCreateUserImage()
    {
        // Mock the required repository
        $this->mock(UserImageCreatorRepository::class)
            ->method('insertUserImage')
            ->willReturn(1);

        $service = $this->container->get(UserImageCreator::class);

        $userImage = new UserImageCreatorData(
            [
                'logo' => 'user-logo-1.jpg',
                'banner' => 'banner-logo-1.png',
            ]
        );

        $actual = $service->createUserImage(1, $userImage);

        $this->assertSame(1, $actual);
    }
}
