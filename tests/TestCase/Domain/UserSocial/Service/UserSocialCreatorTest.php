<?php

namespace App\Test\TestCase\Domain\UserSocial\Service;

use App\Domain\UserSocial\Data\UserSocialCreatorData;
use App\Domain\UserSocial\Repository\UserSocialCreatorRepository;
use App\Domain\UserSocial\Service\UserSocialCreator;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserSocialCreatorTest extends TestCase
{
    use AppTestTrait;

    public function testCreateUserSocial()
    {
        // Mock the required repository
        $this->mock(UserSocialCreatorRepository::class)
            ->method('insertUserSocial')
            ->willReturn(1);

        $service = $this->container->get(UserSocialCreator::class);

        $userSocial = new UserSocialCreatorData([
            'social_id' => 1,
            'profile_username' => 'fb_johndoe',
        ]);

        $actual = $service->createUserSocial($userSocial, 1);

        $this->assertSame(1, $actual);
    }
}
