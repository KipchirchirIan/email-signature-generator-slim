<?php

namespace App\Test\TestCase\Domain\UserTemplate\Service;

use App\Domain\UserTemplate\Repository\UserTemplateCreatorRepository;
use App\Domain\UserTemplate\Service\UserTemplateCreator;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserTemplateCreatorTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test
     *
     * @return void
     */
    public function testCreateUserTemplate(): void
    {
        // Mock the required repository
        $this->mock(UserTemplateCreatorRepository::class)
            ->method('insertUserTemplate')
            ->willReturn(1);

        $service = $this->container->get(UserTemplateCreator::class);

        $actual = $service->createUserTemplate(1, 1);

        $this->assertSame(1, $actual);
    }
}
