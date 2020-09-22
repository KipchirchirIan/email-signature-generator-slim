<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/3/20
 * Time: 3:42 AM
 */

namespace App\Test\TestCase\Domain\Template\Repository;

use App\Domain\Template\Repository\TemplateDeleteRepository;
use App\Test\Fixture\TemplateFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateDeleteRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @var array
     */
    public $fixtures = [
        TemplateFixture::class,
    ];

    /**
     * Create instance
     *
     * @return TemplateDeleteRepository The instance
     */
    public function createInstance(): TemplateDeleteRepository
    {
        return $this->container->get(TemplateDeleteRepository::class);
    }

    /**
     * @return void
     */
    public function testDeleteTemplateById(): void
    {
        $repository = $this->createInstance();

        $templateId = 2;

        $actual = $repository->deleteTemplateById($templateId);

        $this->assertSame(1, $actual);
    }
}
