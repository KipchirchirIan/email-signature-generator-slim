<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 3:30 PM
 */

namespace App\Test\TestCase\Action\UserSocial;


use App\Domain\UserSocial\Repository\UserSocialCreatorRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserSocialCreateActionTest extends TestCase
{
    use AppTestTrait;

    public  function testAction(): void
    {
        $this->mock(UserSocialCreatorRepository::class)
            ->method('insertUserSocial')->willReturn(2);

        $request = $this->createJsonRequest(
            'POST',
            'v1/users/3/socials',
            [
                'social_id' => '1',
                'profile_username' => 'eim.karlie',
            ]
        );
        $response = $this->app->handle($request);

        $this->assertJsonData(
            $response,
            [
                2 => [
                    'userId' => 3,
                    'socialId' => 1,
                    'profileUsername' => 'eim.karlie',
                ]
            ]
        );
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }
}