<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/25/20
 * Time: 4:04 PM
 */

namespace App\Test\TestCase\Action\UserTemplate;


use App\Domain\UserTemplate\Repository\UserTemplateDeleteRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserTemplateDeleteActionTest extends TestCase
{
    use AppTestTrait;

    public function testAction(): void
    {
        $this->mock(UserTemplateDeleteRepository::class)
            ->method('deleteUserTemplate')->willReturn(true);

        $request = $this->createJsonRequest(
            'DELETE',
            'v1/users/1/templates',
            [
                'userTemplateId' => 5
            ]
        );
        $response = $this->app->handle($request);

        $this->assertJsonData($response, ['message' => true]);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }
}