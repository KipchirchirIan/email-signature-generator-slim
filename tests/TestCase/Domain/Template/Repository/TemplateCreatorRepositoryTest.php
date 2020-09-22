<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/1/20
 * Time: 1:05 PM
 */

namespace App\Test\TestCase\Domain\Template\Repository;

use App\Domain\Template\Data\TemplateCreatorData;
use App\Domain\Template\Repository\TemplateCreatorRepository;
use App\Test\Fixture\TemplateFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateCreatorRepositoryTest extends TestCase
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
     * @return TemplateCreatorRepository The instance
     */
    public function createInstance()
    {
        return $this->container->get(TemplateCreatorRepository::class);
    }

    /**
     * @return void
     */
    public function testInsertTemplate()
    {
        $repository = $this->createInstance();

        $template = new TemplateCreatorData(
            [
                'template_name' => 'Template Three',
                'template_desc' => 'This is template 3',
                'template_filename' => 'template_3.html'
            ]
        );

        $actual = $repository->insertTemplate($template);

        $this->assertSame(5, $actual);
    }
}
