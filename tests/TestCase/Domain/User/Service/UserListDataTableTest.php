<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/31/20
 * Time: 12:38 PM
 */

namespace App\Test\TestCase\Domain\User\Service;

use App\Domain\User\Repository\UserListDataTableRepository;
use App\Domain\User\Service\UserListDataTable;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserListDataTableTest extends TestCase
{
    use AppTestTrait;

    public function testListAllUsers()
    {
        // Mock the required repository
        $this->mock(UserListDataTableRepository::class)->method('getTableData')->willReturn(array());

        $service = $this->container->get(UserListDataTable::class);

        $actual = $service->listAllUsers();

        $this->assertSame(array(), $actual);
    }
}
