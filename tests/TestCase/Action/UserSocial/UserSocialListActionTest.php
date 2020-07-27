<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 3:53 PM
 */

namespace App\Test\TestCase\Action\UserSocial;


use App\Domain\UserSocial\Repository\UserSocialViewerRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserSocialListActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * @dataProvider provideUserSocialViewAction
     *
     * @param array $social Social media platform
     */
    public function testAction(array $social, array $expected): void
    {
        $this->mock(UserSocialViewerRepository::class)
            ->method('findAllUserSocialsById')->willReturn($social);

        $request = $this->createRequest('GET', 'v1/users/1/socials');
        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function provideUserSocialViewAction()
    {
        $userSocialView = [
            [
                'userId' => 2,
                'socialId' => 1,
                'profileUsername' => 'halandsman',
            ],
            [
                'userId' => 2,
                'socialId' => 2,
                'profileUsername' => 'halandsman',
            ]
        ];

        return [
            'socialview' => [
                [
                    [
                        'userId' => 2,
                        'socialId' => 1,
                        'profileUsername' => 'halandsman',
                    ],
                    [
                        'userId' => 2,
                        'socialId' => 2,
                        'profileUsername' => 'halandsman',
                    ]
                ],
                $userSocialView
            ]
        ];
    }
}