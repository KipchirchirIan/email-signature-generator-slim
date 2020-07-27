<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/25/20
 * Time: 3:06 PM
 */

namespace App\Test\TestCase\Action\UserTemplate;


use App\Domain\UserTemplate\Repository\UserTemplateViewerRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserTemplateViewActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * @dataProvider provideUserTemplateViewAction
     *
     * @param array $templates List of templates
     * @param array $expected Expected result
     */
    public function testAction(array $templates, array $expected): void
    {
        $this->mock(UserTemplateViewerRepository::class)
            ->method('findAllUserTemplateByUserId')->willReturn($templates);

        $request = $this->createRequest('GET', 'v1/users/2/templates');
        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function provideUserTemplateViewAction()
    {
        $templates = [
            [
                'utpl_id' => '6',
                'user_id' => '2',
                'template_id' => '2',
                'updated_at' => '2020-07-07 04:06:11',
                'created_at' => '2020-07-07 04:06:11',
            ],
            [
                'utpl_id' => '7',
                'user_id' => '2',
                'template_id' => '5',
                'updated_at' => '2020-07-25 13:21:02',
                'created_at' => '2020-07-25 13:21:02',
            ]
        ];

        return [
            'usertemplates' => [
                $templates,
                [
                    [
                        'utpl_id' => '6',
                        'user_id' => '2',
                        'template_id' => '2',
                        'updated_at' => '2020-07-07 04:06:11',
                        'created_at' => '2020-07-07 04:06:11',
                    ],
                    [
                        'utpl_id' => '7',
                        'user_id' => '2',
                        'template_id' => '5',
                        'updated_at' => '2020-07-25 13:21:02',
                        'created_at' => '2020-07-25 13:21:02',
                    ]
                ]
            ]
        ];
    }
}