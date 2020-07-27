<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/25/20
 * Time: 7:00 AM
 */

namespace App\Test\TestCase\Action\Template;


use App\Domain\Template\Repository\TemplateUpdaterRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateUpdateActionTest extends TestCase
{
    use AppTestTrait;

    public function testAction(): void
    {
        $this->mock(TemplateUpdaterRepository::class)
            ->method('updateTemplateById')->willReturn(true);

        $request = $this->createJsonRequest(
            'PUT',
            'v1/templates/4',
            [
                'template_name' => 'template 1',
                'template_desc' => 'This is template 1',
                'template_filename' => 'template1.html'
            ]
        );
        $response = $this->app->handle($request);

        $this->assertJsonData($response, ['result' => true]);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }
}