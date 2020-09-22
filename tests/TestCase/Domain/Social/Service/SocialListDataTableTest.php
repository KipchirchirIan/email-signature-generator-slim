<?php

namespace App\Test\TestCase\Domain\Social\Service;

use App\Domain\Social\Repository\SocialViewerRepository;
use App\Domain\Social\Service\SocialListDataTable;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class SocialListDataTableTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test
     *
     * @return void
     */
    public function testListAllSocials(): void
    {
        // Mock the required repository
        $this->mock(SocialViewerRepository::class)
            ->method('findAllSocials')
            ->willReturn(array());

        $service = $this->container->get(SocialListDataTable::class);

        $actual = $service->listAllSocials();

        $this->assertIsArray($actual);
    }
}
