<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/23/20
 * Time: 6:52 AM
 */

namespace App\Test\TestCase\Action\Home;


use App\Action\Home\HomeAction;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class HomeActionTest extends TestCase
{
    use AppTestTrait;

    public function testAction(): void
    {
        $request = $this->createRequest('GET', '/v1');

        $response = $this->app->handle($request);

        $this->assertJsonData($response,
            ['msg' => 'Welcome to Email Signature Generator REST API',
            'now' => date('d.m.Y H:i:s')]
        );
        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * Test invalid link.
     *
     * @return void
     */
    public function testPageNotFound(): void
    {
        $request = $this->createRequest('GET', '/v1/not-existing-page');
        $response = $this->app->handle($request);

        // Assert: Not found
        static::assertSame(404, $response->getStatusCode());
    }
}