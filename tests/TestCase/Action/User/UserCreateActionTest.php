<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/23/20
 * Time: 11:26 AM
 */

namespace App\Test\TestCase\Action\User;


use App\Domain\User\Repository\UserCreatorRepository;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserCreateActionTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @dataProvider provideUserCreateAction
     *
     * @param int $userId The User ID
     * @param //array $expected The expected result
     */
    public function testAction(int $userId): void
    {
        $this->mock(UserCreatorRepository::class)
            ->method('insertUser')->willReturn($userId);

        $request = $this->createJsonRequest(
            'POST',
            'v1/users',
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@janedoeonline.com',
                'password' => '1234'
            ]
        );

        $response = $this->app->handle($request);

        $this->assertJsonData($response, ['user_id' => 1]);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());

    }

    public function provideUserCreateAction()
    {
        $userId = 1;

        return [
            'userId' => [
                $userId
            ]
        ];
    }
}