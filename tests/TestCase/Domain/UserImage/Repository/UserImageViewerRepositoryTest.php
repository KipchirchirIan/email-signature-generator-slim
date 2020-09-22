<?php

namespace App\Test\TestCase\Domain\UserImage\Repository;

use App\Domain\UserImage\Repository\UserImageViewerRepository;
use App\Test\Fixture\UserFixture;
use App\Test\Fixture\UserImageFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserImageViewerRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    public $fixtures = [
        UserFixture::class,
        UserImageFixture::class,
    ];

    protected function createInstance(): UserImageViewerRepository
    {
        return $this->container->get(UserImageViewerRepository::class);
    }

    public function testGetUserImageByUserId(): void
    {
        $repository = $this->createInstance();

        $actual = $repository->getUserImageByUserId(1);

        $this->assertIsArray($actual);
        $this->assertSame([
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
