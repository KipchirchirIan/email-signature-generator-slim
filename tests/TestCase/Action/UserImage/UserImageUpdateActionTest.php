<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 7:07 AM
 */

namespace App\Test\TestCase\Action\UserImage;


use App\Domain\UserImage\Repository\UserImageUpdaterRepository;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class UserImageUpdateActionTest extends TestCase
{
    use DatabaseTestTrait;

    public function testAction(): void
    {
        $this->mock(UserImageUpdaterRepository::class)
            ->method('updateUserImage')->willReturn(true);

        $request = $this->createJsonRequest(
            'PUT',
            'v1/users/2/images',
            [
                'logo' => 'logo2.png',
                'banner' => 'banner2.jpeg'
            ]
        );
        $response = $this->app->handle($request);

        $this->assertJsonData(
            $response,
            [
                'message' => true,
                'body' => [
                    'logo' => 'logo2.png',
                    'banner' => 'banner2.jpeg'
                ]
            ]
        );
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }
}