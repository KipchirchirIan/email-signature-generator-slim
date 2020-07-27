<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/26/20
 * Time: 6:10 AM
 */

namespace App\Test\TestCase\Action\UserImage;


use App\Domain\UserImage\Repository\UserImageViewerRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserImageViewActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * @dataProvider provideUserImageViewAction
     *
     * @param array $userImages User's image resources
     * @param array $expected Expected results
     */
    public function testAction(array $userImages, array $expected): void
    {
        $this->mock(UserImageViewerRepository::class)
            ->method('getUserImageByUserId')->willReturn($userImages);

        $request = $this->createRequest('GET', 'v1/users/4/images');
        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function provideUserImageViewAction()
    {
        $userImages = [
            'uimg_id' => '7',
            'logo' => 'logo4.png',
            'banner' => 'banner4.jpeg',
            'user_id' => '4',
            'created_at' => '2020-07-25 17:32:27',
            'updated_at' => '2020-07-25 17:32:27',
        ];

        return [
            'userimages' => [
                $userImages,
                [
                    'uimg_id' => '7',
                    'logo' => 'logo4.png',
                    'banner' => 'banner4.jpeg',
                    'user_id' => '4',
                    'created_at' => '2020-07-25 17:32:27',
                    'updated_at' => '2020-07-25 17:32:27',
                ]
            ]
        ];
    }
}