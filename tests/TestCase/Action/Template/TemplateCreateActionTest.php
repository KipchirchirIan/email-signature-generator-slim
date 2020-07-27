<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/25/20
 * Time: 4:47 AM
 */

namespace App\Test\TestCase\Action\Template;


use App\Domain\Template\Repository\TemplateCreatorRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateCreateActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * @dataProvider provideTemplateCreateAction
     *
     * @param int $templateId ID of new template
     */
    public function testAction(int $templateId, array $expected): void
    {
        $this->mock(TemplateCreatorRepository::class)
            ->method('insertTemplate')->willReturn($templateId);

        $request = $this->createJsonRequest(
            'POST',
            'v1/templates',
            [
                'template_name' => 'test 1',
                'template_desc' => 'This is template test 1',
                'template_filename' => 'test1tpl.html'
            ]
        );

        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function provideTemplateCreateAction()
    {
        $templateId = 7;

        return [
            'template' => [
                $templateId,
                [
                    'template_id' => 7
                ]
            ]
        ];
    }
}