<?php

namespace App\Test\TestCase\Domain\UserSocial\Repository;

use App\Domain\UserSocial\Data\UserSocialCreatorData;
use App\Domain\UserSocial\Repository\UserSocialViewerRepository;
use App\Test\Fixture\SocialFixture;
use App\Test\Fixture\UserFixture;
use App\Test\Fixture\UserSocialFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserSocialViewerRepositoryTest extends TestCase
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
     *Create instance
     *
     * @return UserSocialViewerRepository
     */
    protected function createInstance(): UserSocialViewerRepository
    {
        return $this->container->get(UserSocialViewerRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFindAllUserSocialsById(): void
    {
        $repository = $this->createInstance();

        $actual = $repository->findAllUserSocialsById(1);

        $this->assertIsArray($actual);

        //Todo: Use/Create UserSocialViewerData instead
        $this->assertContainsOnlyInstancesOf(UserSocialCreatorData::class, $actual);
    }
}
