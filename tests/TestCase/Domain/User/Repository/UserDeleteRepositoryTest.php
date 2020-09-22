<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/21/20
 * Time: 8:28 AM
 */

namespace App\Test\TestCase\Domain\User\Repository;


use App\Domain\User\Repository\UserDeleteRepository;
use App\Test\Fixture\UserFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserDeleteRepositoryTest extends TestCase
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
     * @return UserDeleteRepository The Instance
     */
    protected function createInstance(): UserDeleteRepository
    {
        return $this->container->get(UserDeleteRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDeleteUserById(): void
    {
        $repository = $this->createInstance();

        $userid = 2;

        $actual = $repository->deleteUserById($userid);

        $this->assertSame(1, $actual);
    }
}