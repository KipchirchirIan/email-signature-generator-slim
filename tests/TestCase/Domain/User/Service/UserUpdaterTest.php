<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/31/20
 * Time: 12:51 PM
 */

namespace App\Test\TestCase\Domain\User\Service;

use App\Domain\User\Data\UserCreatorData;
use App\Domain\User\Repository\UserUpdaterRepository;
use App\Domain\User\Service\UserUpdater;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserUpdaterTest extends TestCase
{
    use AppTestTrait;

    public function testEditUser()
    {
        // Mock the required repository
        $this->mock(UserUpdaterRepository::class)->method('updateUser')->willReturn(true);

        $service = $this->container->get(UserUpdater::class);

        $user = new UserCreatorData(
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@mail.com',
                'password' => '$2y$10$fp2k5zk.G1nSYMCEYeXLluUnHKPv9V4rc2BjiuD8FCKD/sbhjw9mG',
                'company' => 'Jane Doe Inc.',
                'position' => 'Owner',
                'department' => 'Board of Directors',
                'phone' => '0721000222',
                'mobile' => '0721000222',
                'website' => 'www.janedoe.co.uk',
                'skype' => null,
                'address' => 'Jane Doe Street',
                'created_at' => '2020-08-01 12:00:00',
                'updated_at' => '2020-08-01 18:00:00'
            ]
        );

        $actual = $service->editUser($user, 2);

        $this->assertSame(true, $actual);
    }
}
