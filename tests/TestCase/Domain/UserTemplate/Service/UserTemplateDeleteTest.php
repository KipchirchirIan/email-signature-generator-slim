<?php

namespace App\Test\TestCase\Domain\UserTemplate\Service;

use App\Domain\UserTemplate\Repository\UserTemplateDeleteRepository;
use App\Domain\UserTemplate\Service\UserTemplateDelete;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserTemplateDeleteTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test
     *
     * @return void
     */
    public function testDeleteUserTemplateData(): void
    {
        $this->mock(UserTemplateDeleteRepository::class)
            ->method('deleteUserTemplate')
            ->willReturn(true);

        $service = $this->container->get(UserTemplateDelete::class);

        $actual = $service->deleteUserTemplateData(1, 1);

        $this->assertTrue($actual);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDeleteAllUserTemplateData(): void
    {
        $this->mock(UserTemplateDeleteRepository::class)
            ->method('deleteAllUserTemplatesByUserId')
            ->willReturn(true);

        $service = $this->container->get(UserTemplateDelete::class);

        $actual = $service->deleteAllUserTemplateData(1);

        $this->assertTrue($actual);
    }
}
