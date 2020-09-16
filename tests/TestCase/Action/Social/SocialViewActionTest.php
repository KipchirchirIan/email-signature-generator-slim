<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 12:08 PM
 */

namespace App\Test\TestCase\Action\Social;


use App\Domain\Social\Data\SocialViewData;
use App\Domain\Social\Repository\SocialViewerRepository;
use App\Test\TestCase\AppTestTrait;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class SocialViewActionTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @dataProvider provideSocialViewAction
     *
     * @param array $social Social media platform
     */
    public function testAction(array $social, SocialViewData $expected): void
    {
        $this->mock(SocialViewerRepository::class)
            ->method('getSocialById')->willReturn($social);

        $request = $this->createRequest('GET', 'v1/socials/1');
        $response = $this->app->handle($request);

        $this->assertJsonData($response, (array)$expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function provideSocialViewAction()
    {
        $socialView = new SocialViewData(
            [
                'socialId' => '1',
                'social_name' => 'Facebook',
                'social_link' => 'https://www.facebook.com/',
                'profile_link' => 'https://www.facebook.com/',
                'social_description' => 'Facebook is the largest social network',
            ]
        );

        return [
            'socialview' => [
                [
                    'socialId' => '1',
                    'social_name' => 'Facebook',
                    'social_link' => 'https://www.facebook.com/',
                    'profile_link' => 'https://www.facebook.com/',
                    'social_description' => 'Facebook is the largest social network',
                ],
                $socialView
            ]
        ];
    }
}