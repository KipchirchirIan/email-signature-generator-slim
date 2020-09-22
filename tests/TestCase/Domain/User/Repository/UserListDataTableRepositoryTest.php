<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/21/20
 * Time: 8:49 AM
 */

namespace App\Test\TestCase\Domain\User\Repository;

use App\Domain\User\Repository\UserListDataTableRepository;
use App\Test\Fixture\UserFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserListDataTableRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @var array
     */
    public $fixtures = [
        UserFixture::class,
    ];

    /**
     * Create instance
     *
     * @return UserListDataTableRepository
     */
    protected function createInstance(): UserListDataTableRepository
    {
        return $this->container->get(UserListDataTableRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetTableData(): void
    {
        $repository = $this->createInstance();

        $expected = [
            0 =>
                array(
                    'user_id' => '1',
                    'name' => 'John Doe',
                    'company' => 'John Doe & Sons',
                    'position' => 'CEO & Founder',
                    'department' => 'Board of Directors',
                    'phone' => '0721000111',
                    'mobile' => '0721000111',
                    'website' => 'www.johndoe.com',
                    'skype' => null,
                    'address' => 'John Doe Avenue',
                    'email' => 'johndoe@mail.com',
                    'password' => '$2y$10$HewrEzWqSQh20gZqKufaCOw0hEW7hVwmIT/AfejznU0OgJQ13.nl2',
                    'created_at' => '2020-08-01 12:00:00',
                    'updated_at' => '2020-08-01 18:00:00'
                ),
            1 =>
                array(
                    'user_id' => '2',
                    'name' => 'Jane Doe',
                    'company' => 'Jane Doe Inc.',
                    'position' => 'Owner',
                    'department' => 'Board of Directors',
                    'phone' => '0721000222',
                    'mobile' => '0721000222',
                    'website' => null,
                    'skype' => null,
                    'address' => 'Jane Doe Lane',
                    'email' => 'janedoe@mail.com',
                    'password' => '$2y$10$fp2k5zk.G1nSYMCEYeXLluUnHKPv9V4rc2BjiuD8FCKD/sbhjw9mG',
                    'created_at' => '2020-08-01 12:00:00',
                    'updated_at' => '2020-08-01 18:00:00'
                ),
        ];

        $actual = $repository->getTableData();

        $this->assertSame($expected, $actual);
    }
}
