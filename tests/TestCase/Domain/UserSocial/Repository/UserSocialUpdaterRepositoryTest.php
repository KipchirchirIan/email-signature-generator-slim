<?php

namespace App\Test\TestCase\Domain\UserSocial\Repository;

use App\Domain\UserSocial\Data\UserSocialUpdaterData;
use App\Domain\UserSocial\Repository\UserSocialUpdaterRepository;
use App\Test\Fixture\SocialFixture;
use App\Test\Fixture\UserFixture;
use App\Test\Fixture\UserSocialFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserSocialUpdaterRepositoryTest extends TestCase
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
     * @return UserSocialUpdaterRepository The instance
     */
    protected function createInstance(): UserSocialUpdaterRepository
    {
        return $this->container->get(UserSocialUpdaterRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testUpdateUserSocials(): void
    {
        $repository = $this->createInstance();

        $userSocial = new UserSocialUpdaterData([
            'social_id' => 1,
            'profile_username' => 'fb.johndoe'
        ]);

        $actual = $repository->updateUserSocials($userSocial, 1);

        $this->assertTrue($actual);
    }
}
