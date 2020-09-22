<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/27/20
 * Time: 12:48 PM
 */

namespace App\Test\TestCase\Domain\User\Repository;

use App\Domain\User\Data\UserViewData;
use App\Domain\User\Repository\UserViewerRepository;
use App\Test\Fixture\UserFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserViewerRepositoryTest extends TestCase
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
     * @return UserViewerRepository
     */
    protected function createInstance(): UserViewerRepository
    {
        return $this->container->get(UserViewerRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetUserById(): void
    {
        $repository = $this->createInstance();

        $expected = [
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
                'updated_at' => '2020-08-01 18:00:00',
            ];

        $actual = $repository->getUserById(1);

        $this->assertSame($expected, $actual);
    }
}
