<?php

namespace App\Test\TestCase\Domain\UserTemplate\Repository;

use App\Domain\UserTemplate\Repository\UserTemplateDeleteRepository;
use App\Test\Fixture\TemplateFixture;
use App\Test\Fixture\UserFixture;
use App\Test\Fixture\UserTemplateFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserTemplateDeleteRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @var array
     */
    public $fixtures = [
        UserFixture::class,
        TemplateFixture::class,
        UserTemplateFixture::class,
    ];

    /**
     * Create instance
     *
     * @return UserTemplateDeleteRepository The instance
     */
    protected function createInstance(): UserTemplateDeleteRepository
    {
        return $this->container->get(UserTemplateDeleteRepository::class);
    }

    public function testDeleteAllUserTemplatesByUserId()
    {
        $repository = $this->createInstance();

        $actual = $repository->deleteAllUserTemplatesByUserId(1);

        $this->assertTrue($actual);
    }

    public function testDeleteUserTemplate()
    {
        $repository = $this->createInstance();

        $actual = $repository->deleteAllUserTemplatesByUserId(2);

        $this->assertTrue($actual);
    }
}
