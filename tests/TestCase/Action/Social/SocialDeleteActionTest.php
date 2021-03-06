<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 2:32 PM
 */

namespace App\Test\TestCase\Action\Social;


use App\Domain\Social\Repository\SocialDeleteRepository;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class SocialDeleteActionTest extends TestCase
{
    use DatabaseTestTrait;

    public function testAction(): void
    {
        $this->mock(SocialDeleteRepository::class)
            ->method('deleteSocialById')->willReturn(true);

        $request = $this->createRequest('DELETE', 'v1/socials/7')
            ->withHeader('Authorization', 'Bearer ' . $this->container->get('settings')['token']);

        $response = $this->app->handle($request);

        $this->assertJsonData($response, ['message' => true]);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
    }
}