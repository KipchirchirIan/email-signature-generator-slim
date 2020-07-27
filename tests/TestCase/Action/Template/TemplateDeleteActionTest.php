<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/25/20
 * Time: 12:21 PM
 */

namespace App\Test\TestCase\Action\Template;


use App\Domain\Template\Repository\TemplateDeleteRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateDeleteActionTest extends TestCase
{
    use AppTestTrait;

    public function testAction(): void
    {
        $this->mock(TemplateDeleteRepository::class)
            ->method('deleteTemplateById')->willReturn(1);

        $request = $this->createRequest('DELETE', 'v1/templates/2');
        $response = $this->app->handle($request);

        $this->assertJsonData($response, ['result' => true]);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }
}