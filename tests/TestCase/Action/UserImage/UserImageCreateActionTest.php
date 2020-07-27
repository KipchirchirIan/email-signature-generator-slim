<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/25/20
 * Time: 4:58 PM
 */

namespace App\Test\TestCase\Action\UserImage;


use App\Domain\UserImage\Repository\UserImageCreatorRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserImageCreateActionTest //extends TestCase
{
    use AppTestTrait;

    public function testWithValidUser(): void
    {
        $this->mock(UserImageCreatorRepository::class)
            ->method('insertUserImage')->willReturn(2);

        $request = $this->createJsonRequest(
            'POST',
            'v1/users/2/images',
            [
                'logo' => 'logo2.png',
                'banner' => 'banner2.jpeg'
            ]
        );
        $response = $this->app->handle($request);

        $this->assertJsonData($response, [
            'id' => 2,
            'logo' => 'logo2.png',
            'banner' => 'banner2.jpeg',
            'userId' => 2
        ]);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

//    public function testWithInvalidUser(): void
//    {
//        $this->mock(UserImageCreatorRepository::class)
//            ->method('insertUserImage')->willReturn(11);
//
//        $request = $this->createJsonRequest(
//            'POST',
//            'v1/users/99/images',
//            [
//                'logo' => 'logo2.png',
//                'banner' => 'banner2.jpeg'
//            ]
//        );
//        $response = $this->app->handle($request);
//
//        $this->assertStringContainsString('User not found', (string)$response->getBody());
//        $this->assertSame('text/html', $response->getHeaderLine('Content-Type'));
//        $this->assertSame(500, $response->getStatusCode());
//        $this->expectException(\DomainException::class);
//    }

}