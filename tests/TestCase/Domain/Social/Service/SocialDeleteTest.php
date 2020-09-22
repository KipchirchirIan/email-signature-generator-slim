<?php

namespace App\Test\TestCase\Domain\Social\Service;

use App\Domain\Social\Repository\SocialDeleteRepository;
use App\Domain\Social\Service\SocialDelete;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class SocialDeleteTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test
     *
     * @return void
     */
    public function testRemoveSocialById(): void
    {
        // Mock the required repository
        $this->mock(SocialDeleteRepository::class)
            ->method('deleteSocialById')
            ->willReturn(true);

        $service = $this->container->get(SocialDelete::class);

        $actual = $service->removeSocialById(2);

        $this->assertTrue($actual);
    }
}
