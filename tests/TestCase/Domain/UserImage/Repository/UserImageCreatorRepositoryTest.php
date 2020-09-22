<?php

namespace App\Test\TestCase\Domain\UserImage\Repository;

use App\Domain\UserImage\Data\UserImageCreatorData;
use App\Domain\UserImage\Repository\UserImageCreatorRepository;
use App\Test\Fixture\UserFixture;
use App\Test\Fixture\UserImageFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserImageCreatorRepositoryTest extends TestCase
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
     * @return UserImageCreatorRepository
     */
    protected function createInstance(): UserImageCreatorRepository
    {
        return $this->container->get(UserImageCreatorRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInsertUserImage(): void
    {
        $repository = $this->createInstance();

        $userImage = new UserImageCreatorData(
            [
                'logo' => 'user-2.jpg',
                'banner' => 'banner_2.png'
            ]
        );

        $actual = $repository->insertUserImage(2, $userImage);

        $this->assertSame(3, $actual);
    }
}
