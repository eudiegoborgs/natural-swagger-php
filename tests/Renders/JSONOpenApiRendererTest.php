<?php declare(strict_types=1);

namespace Tests\Renders;

use Diegoborgs\NaturalSwaggerPhp\Renders\JSONOpenApiRenderer;
use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;
use OpenApi\Annotations\OpenApi;
use PHPUnit\Framework\TestCase;

class JSONOpenApiRendererTest extends TestCase
{
    public function testRender(): void
    {
        $renderer = new JSONOpenApiRenderer();
        $open_api_mock = $this->createMock(OpenApi::class);
        $open_api_mock->expects($this->once())
            ->method('toJson')
            ->willReturn('{"data": "value"}');
        $json = $renderer->render($open_api_mock);
        $this->assertEquals('{"data": "value"}', $json);
    }

    public function testGetFormat()
    {
        $renderer = new JSONOpenApiRenderer();
        $this->assertEquals(RenderOpenApi::JSON, $renderer->getFormat());
    }
}
