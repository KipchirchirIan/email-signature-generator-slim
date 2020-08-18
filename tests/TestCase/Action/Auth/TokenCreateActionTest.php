<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/14/20
 * Time: 11:19 AM
 */

namespace App\Test\TestCase\Action\Auth;

use App\Domain\User\Repository\SuperUserAuthRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TokenCreateActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * @dataProvider provideTokenCreateActionInvalid
     *
     * @param array $superuser
     */
    public function testInvalidCredentials(array $superuser, array $expected): void
    {
        $this->mock(SuperUserAuthRepository::class)
            ->method('findSuperUserByEmail')->willReturn($superuser);

        $request = $this->createJsonRequest(
            'POST',
            'v1/tokens',
            [
                'username' => 'abc@cmshosting.xyz',
                'password' => '1234'
            ]
        );

        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(401, $response->getStatusCode());
    }

    /**
     * @dataProvider  provideTokenCreateActionValid
     *
     * @param array $expected
     * @param array $superuser
     */
//    public function testValidCredentials(array $superuser): void
//    {
//        $this->mock(SuperUserAuthRepository::class)
//            ->method('findSuperUserByEmail')->willReturn($superuser);
//
//        $request = $this->createJsonRequest(
//            'POST',
//            'v1/tokens',
//            [
//                'username' => 'abc@cmshosting.xyz',
//                'password' => '1234'
//            ]
//        );
//
//        $response = $this->app->handle($request);
//
//        $this->assertJsonData(
//            $response,
//            [
//                'access_token' => $this->container->get('settings')['token'],
//                'token_type' => 'Bearer',
//                'expires_in' => 14400
//            ]
//        );
//        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
//        $this->assertSame(201, $response->getStatusCode());
//    }

//    public function provideTokenCreateActionValid()
//    {
//        $superuser = [
//            'email' => 'test@cmshosting.xyz',
//            'password' => 'cmshosting.xyz'
//        ];
//        $expected = [
//            'access_token' => '1234',
//            'token_type' => 'Bearer',
//            'expires_in' => 14400
//        ];
//
//        return [
//            'tokenValid' => [
//                $superuser,
//                $expected
//            ]
//        ];
//    }

    public function provideTokenCreateActionInvalid()
    {
        $superuser = [
            'email' => 'test@cmshosting.xyz',
            'password' => '1234'
        ];
        $expected = ['message' => 'Invalid credentials'];

        return [
            'tokenInvalid' => [
                $superuser,
                $expected
            ]
        ];
    }
}