<?php

namespace App\Test\TestCase\Domain\UserSocial\Repository;

use App\Domain\UserSocial\Data\UserSocialCreatorData;
use App\Domain\UserSocial\Repository\UserSocialCreatorRepository;
use App\Test\Fixture\SocialFixture;
use App\Test\Fixture\UserFixture;
use App\Test\Fixture\UserSocialFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserSocialCreatorRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @var array
     */
    public $fixtures = [
        UserFixture::class,
        SocialFixture::class,
        UserSocialFixture::class,
    ];

    /**
     * Create instance
     *
     * @return UserSocialCreatorRepository The instance
     */
    protected function createInstance(): UserSocialCreatorRepository
    {
        return $this->container->get(UserSocialCreatorRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInsertUserSocial(): void
    {
        $repository = $this->createInstance();

        $userSocial = new UserSocialCreatorData(
            [
                'social_id' => 1,
                'profile_username' => 'janedoe',
            ]
        );

        $actual = $repository->insertUserSocial($userSocial, 2);

        $this->assertSame(4, $actual);
    }
}
