<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 4:05 PM
 */

namespace App\Test\TestCase\Action\UserSocial;


use App\Domain\UserSocial\Repository\UserSocialUpdaterRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserSocialUpdateActionTest extends TestCase
{
    use AppTestTrait;

    public function testAction(): void
    {
        $this->mock(UserSocialUpdaterRepository::class)
            ->method('updateUserSocials')->willReturn(true);

        $request = $this->createJsonRequest(
            'PUT',
            'v1/users/2/socials',
            [
                'social_id' => '3',
                'profile_username' => 'karen.jenken',
            ]
        );
        $response = $this->app->handle($request);

        $this->assertJsonData(
            $response,
            [
                'message' => true,
                'body' => [
                    'socialId' => 3,
                    'profileUsername' => 'karen.jenken',
                ]
            ]
        );
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }
}