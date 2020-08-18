<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/23/20
 * Time: 3:20 PM
 */

namespace App\Test\TestCase\Action\User;


use App\Domain\User\Repository\UserDeleteRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserDeleteActionTest extends TestCase
{
    use AppTestTrait;

    public function testAction(): void
    {
        $this->mock(UserDeleteRepository::class)
            ->method('deleteUserById')->willReturn(1);

        $request = $this->createRequest('DELETE', 'v1/users/7')
            ->withHeader('Authorization', 'Bearer ' . $this->container->get('settings')['token']);


        $response = $this->app->handle($request);

        $this->assertJsonData($response, ['result' => true]);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
    }
}