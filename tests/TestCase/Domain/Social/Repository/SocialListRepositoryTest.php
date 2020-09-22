<?php

namespace App\Test\TestCase\Domain\Social\Repository;

use App\Domain\Social\Repository\SocialViewerRepository;
use App\Test\Fixture\SocialFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class SocialListRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    public $fixtures = [
        SocialFixture::class,
    ];

    protected function createInstance(): SocialViewerRepository
    {
        return $this->container->get(SocialViewerRepository::class);
    }

    public function testFindAllSocials()
    {
        $repository = $this->createInstance();

        $actual = $repository->findAllSocials();

        $this->assertIsArray($actual);
    }
}
