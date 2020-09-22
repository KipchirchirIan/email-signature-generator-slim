<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/20/20
 * Time: 9:43 AM
 */

namespace App\Test\TestCase\Domain\User\Repository;


use App\Domain\User\Data\UserCreatorData;
use App\Domain\User\Repository\UserCreatorRepository;
use App\Test\Fixture\UserFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserCreatorRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @var array
     */
    public $fixtures = [
        UserFixture::class,
    ];

    /**
     * Create Instance
     *
     * @return UserCreatorRepository The Instance
     */
    protected function createInstance(): UserCreatorRepository
    {
        return $this->container->get(UserCreatorRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInsertUser(): void
    {
        $repository = $this->createInstance();

        $user = new UserCreatorData(
            [
                'name' => 'User One',
                'email' => 'user1@mail.com',
                'password' => '$2y$10$fp2k5zk.G1nSYMCEYeXLluUnHKPv9V4rc2BjiuD8FCKD/sbhjw9mG',
            ]
        );

        $actual = $repository->insertUser($user);

        $this->assertSame(4, $actual);
    }
}