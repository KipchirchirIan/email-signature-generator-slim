<?php

namespace App\Test\TestCase\Domain\UserImage\Repository;

use App\Domain\UserImage\Data\UserImageUpdaterData;
use App\Domain\UserImage\Repository\UserImageUpdaterRepository;
use App\Test\Fixture\UserFixture;
use App\Test\Fixture\UserImageFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserImageUpdaterRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @var array
     */
    public $fixtures = [
        UserFixture::class,
        UserImageFixture::class,
    ];

    /**
     * Create instance
     *
     * @return UserImageUpdaterRepository
     */
    protected function createInstance(): UserImageUpdaterRepository
    {
        return $this->container->get(UserImageUpdaterRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testUpdateUserImage(): void
    {
        $repository = $this->createInstance();

        $userImage = new UserImageUpdaterData(
            [
                'logo' => 'user-logo-1.gif',
                'banner' => null,
            ]
        );

        $actual = $repository->updateUserImage($userImage, 1);

        $this->assertTrue($actual);
    }
}
