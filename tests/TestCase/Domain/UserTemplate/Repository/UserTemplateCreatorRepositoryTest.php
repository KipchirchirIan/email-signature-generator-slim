<?php

namespace App\Test\TestCase\Domain\UserTemplate\Repository;

use App\Domain\UserTemplate\Repository\UserTemplateCreatorRepository;
use App\Test\Fixture\TemplateFixture;
use App\Test\Fixture\UserFixture;
use App\Test\Fixture\UserTemplateFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserTemplateCreatorRepositoryTest extends TestCase
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
     * @return UserTemplateCreatorRepository The instance
     */
    protected function createInstance(): UserTemplateCreatorRepository
    {
        return $this->container->get(UserTemplateCreatorRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetTemplateById(): void
    {
        $repository = $this->createInstance();

        $actual = $repository->getTemplateById(2);

        $this->assertTrue($actual);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFindUserTemplateByTemplateId(): void
    {
        $repository = $this->createInstance();

        $actual = $repository->findUserTemplateByTemplateId(1, 2);

        $this->assertFalse($actual);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInsertUserTemplate(): void
    {
        $repository = $this->createInstance();

        $actual = $repository->insertUserTemplate(1, 2);

        $this->assertSame(3, $actual);
    }
}
