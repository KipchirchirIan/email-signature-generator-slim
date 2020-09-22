<?php

namespace App\Test\TestCase\Domain\UserSocial\Service;

use App\Domain\UserSocial\Data\UserSocialCreatorData;
use App\Domain\UserSocial\Repository\UserSocialViewerRepository;
use App\Domain\UserSocial\Service\UserSocialCreator;
use App\Domain\UserSocial\Service\UserSocialListDataTable;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserSocialListDataTableTest extends TestCase
{
    use AppTestTrait;

    public function testListAllUserSocials()
    {
        $userSocial = new UserSocialCreatorData(
            [
                'social_id' => 1,
                'profile_username' => 'johndoe',
                'user_id' => 1,
            ]
        );

        // Mock the required repository
        $this->mock(UserSocialViewerRepository::class)
            ->method('findAllUserSocialsById')
            ->willReturn([
                $userSocial,
            ]);

        $service = $this->container->get(UserSocialListDataTable::class);

        $actual = $service->listAllUserSocials(1);

        // Todo: Check on appropriate way of testing this
        $expectedUserSocial = $userSocial;

        $this->assertSame(
            [
                $expectedUserSocial,
            ],
            $actual
        );
    }
}
