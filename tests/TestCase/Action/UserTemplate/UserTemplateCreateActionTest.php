<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/25/20
 * Time: 12:49 PM
 */

namespace App\Test\TestCase\Action\UserTemplate;


use App\Domain\UserTemplate\Repository\UserTemplateCreatorRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserTemplateCreateActionTest //extends TestCase
{
    use AppTestTrait;

    public function testAction(): void
    {
        $this->mock(UserTemplateCreatorRepository::class)
            ->method('insertUserTemplate')->willReturn(7);

        $request = $this->createJsonRequest(
            'POST',
            'v1/users/2/templates',
            [
                'tplid' => "5"
            ]
        );
        $response = $this->app->handle($request);

        $this->assertJsonData($response, ['userTemplateId' => 7]);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }
}