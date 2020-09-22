<?php

namespace App\Test\TestCase\Domain\UserTemplate\Repository;

use App\Domain\UserTemplate\Repository\UserTemplateViewerRepository;
use App\Test\Fixture\TemplateFixture;
use App\Test\Fixture\UserFixture;
use App\Test\Fixture\UserTemplateFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserTemplateViewerRepositoryTest extends TestCase
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
     * @return UserTemplateViewerRepository The instance
     */
    protected function createInstance(): UserTemplateViewerRepository
    {
        return $this->container->get(UserTemplateViewerRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFindAllUserTemplateByUserId()
    {
        $repository = $this->createInstance();

        $actual = $repository->findAllUserTemplateByUserId(1);

        $templates = [
            [
                'utpl_id' => '1',
                'user_id' => '1',
                'template_id' => '1',
                'created_at' => '2020-09-22 07:23:15',
                'updated_at' => '2020-09-22 08:33:02'
            ],
        ];

        $this->assertIsArray($actual);
        $this->assertSame($templates, $actual);
    }
}
