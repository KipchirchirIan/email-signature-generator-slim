<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/25/20
 * Time: 5:53 AM
 */

namespace App\Test\TestCase\Action\Template;


use App\Domain\Template\Repository\TemplateViewerRepository;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateViewActionTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @dataProvider provideTemplateViewAction
     *
     * @param array $template The template
     * @param array $expected Expected result
     *
     */
    public function testAction(array $template, array $expected): void
    {
        $this->mock(TemplateViewerRepository::class)
            ->method('getTemplateById')->willReturn($template);

        $request = $this->createRequest('GET', 'v1/templates/1');
        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function provideTemplateViewAction()
    {
        $template = [
            'template_id' => '1',
            'template_name' => 'template 1',
            'template_desc' => 'This is template 1',
            'template_filename' => 'template1.html',
            'created_at' => '2020-05-16 05:05:19',
            'updated_at' => '2020-05-16 05:05:19'
        ];

        $expected = [
            'template' => [
                'template_id' => '1',
                'template_name' => 'template 1',
                'template_desc' => 'This is template 1',
                'template_filename' => 'template1.html',
                'created_at' => '2020-05-16 05:05:19',
                'updated_at' => '2020-05-16 05:05:19'
            ]
        ];

        return [
            'templateview' => [
                $template,
                $expected
            ]
        ];
    }
}