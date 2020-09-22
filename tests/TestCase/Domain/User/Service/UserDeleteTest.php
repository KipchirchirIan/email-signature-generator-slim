<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/28/20
 * Time: 12:47 PM
 */

namespace App\Test\TestCase\Domain\User\Service;

use App\Domain\User\Repository\UserDeleteRepository;
use App\Domain\User\Service\UserDelete;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserDeleteTest extends TestCase
{
    use AppTestTrait;

    public function testDeleteUserData()
    {
        //  Mock the required repository
        $this->mock(UserDeleteRepository::class)->method('deleteUserById')->willReturn(1);

        $service = $this->container->get(UserDelete::class);

        $actual = $service->deleteUserData(2);

        $this->assertSame(true, $actual);
    }
}
