<?php

namespace App\Test\TestCase\Domain\Social\Repository;

use App\Domain\Social\Repository\SocialViewerRepository;
use App\Domain\User\Repository\UserViewerRepository;
use App\Test\Fixture\SocialFixture;
use App\Test\TestCase\DatabaseTestTrait;
use App\Test\TestCase\Domain\User\Repository\UserViewerRepositoryTest;
use PHPUnit\Framework\TestCase;

class SocialViewerRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    public $fixtures = [
        SocialFixture::class,
    ];

    protected function createInstance(): SocialViewerRepository
    {
        return $this->container->get(SocialViewerRepository::class);
    }

    public function testGetSocialById()
    {
        $repository = $this->createInstance();

        $actual = $repository->getSocialById(2);

        $social = [
            'social_id' => '2',
            'social_name' => 'GitHub',
            'social_link' => 'https://www.github.com/',
            'social_profile_link' => 'https://www.github.com/',
            'social_desc' => 'Social network for devs',
            'created_at' => '2020-08-01 09:00:00',
            'updated_at' => '2020-08-01 15:00:00'
        ];

        $this->assertSame($social, $actual);
    }
}
