<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/24/20
 * Time: 12:44 PM
 */

namespace App\Test\TestCase\Action\User;


use App\Domain\User\Repository\UserUpdaterRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserUpdateActionTest extends TestCase
{
    use AppTestTrait;

    public function testAction(): void
    {
        $this->mock(UserUpdaterRepository::class)
            ->method('updateUser')->willReturn(true);

        $request = $this->createJsonRequest(
            'PUT',
            'v1/users/7',
            [
                'name' => 'Jane Doe',
                'company' => 'Jane Doe LLC',
                'position' => 'Sales Representative',
                'department' => 'Sales & Marketing',
                'mobile' => '0711000111',
                'phone' => '0711000111',
                'address' => 'Palm Beach Ave.',
                'skype' => 'janedoe',
                'website' => 'www.janedoeonline.com',
                'email' => 'janedoe@janedoeonline.com',
                'password' => '1234'
            ]
        );

        $response = $this->app->handle($request);

        $this->assertJsonData($response, ['message' => true]);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }
}