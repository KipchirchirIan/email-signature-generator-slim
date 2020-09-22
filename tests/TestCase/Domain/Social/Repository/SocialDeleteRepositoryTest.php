<?php

namespace App\Test\TestCase\Domain\Social\Repository;

use App\Domain\Social\Repository\SocialDeleteRepository;
use App\Test\Fixture\SocialFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class SocialDeleteRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @var array
     */
    public $fixtures = [
        SocialFixture::class,
    ];

    protected function createInstance(): SocialDeleteRepository
    {
        return $this->container->get(SocialDeleteRepository::class);
    }

    public function testDeleteSocialById(): void
    {
        $repository = $this->createInstance();

        $socialId = 2;

        $actual = $repository->deleteSocialById($socialId);

        self::assertSame(true, $actual);
    }
}
