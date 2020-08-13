<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/23/20
 * Time: 5:33 AM
 */

namespace App\Test\TestCase\Action;


use App\Domain\User\Data\UserViewData;
use App\Domain\User\Repository\UserViewerRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserViewActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * @dataProvider provideUserReaderAction
     *
     * @param UserViewData $user The user
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testUserReaderAction(UserViewData $user, array $expected): void
    {
        $this->mock(UserViewerRepository::class)
            ->method('getUserById')->willReturn($user);

        $request = $this->createRequest('GET', 'v1/users/1');

        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertJsonData($response, $expected);
    }

    /**
     * @return array The data
     */
    public function provideUserReaderAction(): array
    {
        $user = new UserViewData();
        $user->id = 1;
        $user->name = 'John Doe';
        $user->email = 'johndoe@example.com';

        $expected = [
            'user' => [
                'id' => 1,
                'email' => 'johndoe@example.com',
                'name' => 'John Doe'
            ]
        ];

        return [
            'user' => [
                $user,
                 $expected
            ]
        ];
    }
}