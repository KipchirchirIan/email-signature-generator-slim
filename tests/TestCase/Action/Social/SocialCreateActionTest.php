<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 11:50 AM
 */

namespace App\Test\TestCase\Action\Social;


use App\Domain\Social\Repository\SocialCreatorRepository;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class SocialCreateActionTest extends TestCase
{
    use DatabaseTestTrait;

    public function testAction(): void
    {
        $this->mock(SocialCreatorRepository::class)
            ->method('insertSocial')->willReturn(2);

        $request = $this->createJsonRequest(
            'POST',
            'v1/socials',
            [
                'social_name' => 'Test Inc.',
                'social_link' => 'https://www.test.com/',
                'profile_link' => 'https://www.test.com/profile/',
                'social_description' => 'Test Social Network',
            ]
        )->withHeader('Authorization', 'Bearer ' . $this->container->get('settings')['token']);

        $response = $this->app->handle($request);

        $this->assertJsonData(
            $response,
            [
                2 => [
                    'social_name' => 'Test Inc.',
                    'social_link' => 'https://www.test.com/',
                    'profile_link' => 'https://www.test.com/profile/',
                    'social_description' => 'Test Social Network',
                ]
            ]
        );
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }
}