<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/31/20
 * Time: 1:10 PM
 */

namespace App\Test\TestCase\Domain\User\Service;

use App\Domain\User\Data\UserViewData;
use App\Domain\User\Repository\UserViewerRepository;
use App\Domain\User\Service\UserViewer;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserViewerTest extends TestCase
{
    use AppTestTrait;

    public function testGetUserViewData()
    {
        $this->mock(UserViewerRepository::class)
            ->method('getUserById')
            ->willReturn(array());

        $service = $this->container->get(UserViewer::class);

        $actual = $service->getUserViewData(1);

        $this->assertInstanceOf(UserViewData::class, $actual);
        $this->assertIsObject($actual);
    }

}
