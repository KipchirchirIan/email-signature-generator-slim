<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/9/20
 * Time: 2:01 AM
 */

namespace App\Test\TestCase\Domain\Template\Repository;

use App\Domain\Template\Data\TemplateCreatorData;
use App\Domain\Template\Repository\TemplateUpdaterRepository;
use App\Test\Fixture\TemplateFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateUpdaterRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    public $fixtures = [
        TemplateFixture::class,
    ];

    public function createInstance(): TemplateUpdaterRepository
    {
        return $this->container->get(TemplateUpdaterRepository::class);
    }

    public function testUpdateTemplateById()
    {
        $repository = $this->createInstance();

        $template = new TemplateCreatorData(
            [
                'template_name' => 'Template One',
                'template_desc' => 'This is template 1. A minimalist template',
                'template_filename' => 'template_one.html'
            ]
        );

        $actual = $repository->updateTemplateById($template, 1);

        $this->assertSame(true, $actual);
    }
}
