<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/21/20
 * Time: 9:22 AM
 */

namespace App\Test\TestCase\Domain\User\Repository;

use App\Domain\User\Data\UserCreatorData;
use App\Domain\User\Repository\UserUpdaterRepository;
use App\Test\Fixture\UserFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserUpdaterRepositoryTest extends TestCase
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
     * @return UserUpdaterRepository
     */
    protected function createInstance(): UserUpdaterRepository
    {
       return $this->container->get(UserUpdaterRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testUpdateUser(): void
    {
        $repository = $this->createInstance();

        $user = new UserCreatorData([
            'name' => 'John Doe',
            'company' => 'John Doe Limited',
            'website' => 'www.johndoe.com',
            'skype' => 'john.doe',
        ]);

        $actual = $repository->updateUser($user,1);

        $this->assertSame(true, $actual);
    }
}
