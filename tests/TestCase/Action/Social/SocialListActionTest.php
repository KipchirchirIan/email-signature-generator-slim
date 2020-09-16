<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 2:42 PM
 */

namespace App\Test\TestCase\Action\Social;


use App\Domain\Social\Repository\SocialViewerRepository;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class SocialListActionTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @dataProvider provideSocialViewAction
     *
     * @param array $social Social media platform
     */
    public function testAction(array $social, array $expected): void
    {
        $this->mock(SocialViewerRepository::class)
            ->method('findAllSocials')->willReturn($social);

        $request = $this->createRequest('GET', 'v1/socials');
        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function provideSocialViewAction()
    {
        $socialView = [
            [
                'socialId' => '1',
                'social_name' => 'Facebook',
                'social_link' => 'https://www.facebook.com/',
                'profile_link' => 'https://www.facebook.com/',
                'social_description' => 'Facebook is the largest social network',
            ],
            [
                'socialId' => '2',
                'social_name' => 'Facebook',
                'social_link' => 'https://www.facebook.com/',
                'profile_link' => 'https://www.facebook.com/',
                'social_description' => 'Facebook is the largest social network',
            ]
        ];

        return [
            'socialview' => [
                [
                    [
                        'socialId' => '1',
                        'social_name' => 'Facebook',
                        'social_link' => 'https://www.facebook.com/',
                        'profile_link' => 'https://www.facebook.com/',
                        'social_description' => 'Facebook is the largest social network',
                    ],
                    [
                        'socialId' => '2',
                        'social_name' => 'Facebook',
                        'social_link' => 'https://www.facebook.com/',
                        'profile_link' => 'https://www.facebook.com/',
                        'social_description' => 'Facebook is the largest social network',
                    ]
                ],
                $socialView
            ]
        ];
    }
}