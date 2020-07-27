<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 2:06 PM
 */

namespace App\Test\TestCase\Action\Social;


use App\Domain\Social\Repository\SocialUpdaterRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class SocialUpdateActionTest extends TestCase
{
    use AppTestTrait;

    public function testAction(): void
    {
        $this->mock(SocialUpdaterRepository::class)
            ->method('updateSocialById')->willReturn(true);

        $request = $this->createJsonRequest(
            'PUT',
            'v1/socials/1',
            [
                'social_name' => 'Test Inc.',
                'social_link' => 'https://www.test.com/',
                'profile_link' => 'https://www.test.com/profile/',
                'social_description' => 'Test Social Network',
            ]
        );
        $response = $this->app->handle($request);

        $this->assertJsonData(
            $response,
            [
                'message' => true,
                'body' => [
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