<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/28/20
 * Time: 12:31 PM
 */

namespace App\Test\TestCase\Domain\User\Service;

use App\Domain\User\Data\UserCreatorData;
use App\Domain\User\Repository\UserCreatorRepository;
use App\Domain\User\Service\UserCreator;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserCreatorTest extends TestCase
{
    use AppTestTrait;

    public function testCreateUser()
    {
        $this->mock(UserCreatorRepository::class)->method('insertUser')->willReturn(1);

        $service = $this->container->get(UserCreator::class);

        $user = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => '$2y$10$fp2k5zk.G1nSYMCEYeXLluUnHKPv9V4rc2BjiuD8FCKD/sbhjw9mG',
        ];

        $actual = $service->createUser(new UserCreatorData($user));

        $this->assertSame(1, $actual);
    }
}
