<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/25/20
 * Time: 6:25 AM
 */

namespace App\Test\TestCase\Action\Template;


use App\Domain\Template\Repository\TemplateViewerRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateListActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * @dataProvider provideTemplateListAction
     *
     * @param array $templates List of templates
     * @param array $expected Expected result
     */
    public function testAction(array $templates, array $expected): void
    {
        $this->mock(TemplateViewerRepository::class)
            ->method('findAllTemplates')->willReturn($templates);

        $request = $this->createRequest('GET', 'v1/templates');
        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function provideTemplateListAction()
    {
        $templates = [
            [
                'template_id' => '1',
                'template_name' => 'template 1',
                'template_desc' => 'This is template 1',
                'template_filename' => 'template1.html',
                'created_at' => '2020-05-16 05:05:19',
                'updated_at' => '2020-05-16 05:05:19',
            ],
            [
                'template_id' => '3',
                'template_name' => 'template 3',
                'template_desc' => 'This is template 3',
                'template_filename' => 'template_3.html',
                'created_at' => '2020-05-21 04:45:40',
                'updated_at' => '2020-05-21 04:45:40',
            ]
        ];
        return [
            'templatelist' => [
                $templates,
                [
                    [
                        'template_id' => '1',
                        'template_name' => 'template 1',
                        'template_desc' => 'This is template 1',
                        'template_filename' => 'template1.html',
                        'created_at' => '2020-05-16 05:05:19',
                        'updated_at' => '2020-05-16 05:05:19',
                    ],
                    [
                        'template_id' => '3',
                        'template_name' => 'template 3',
                        'template_desc' => 'This is template 3',
                        'template_filename' => 'template_3.html',
                        'created_at' => '2020-05-21 04:45:40',
                        'updated_at' => '2020-05-21 04:45:40',
                    ]
                ]
            ]
        ];
    }
}