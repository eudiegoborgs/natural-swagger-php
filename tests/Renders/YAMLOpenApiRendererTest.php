<?php declare(strict_types=1);

namespace Tests\Renders;

use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;
use Diegoborgs\NaturalSwaggerPhp\Renders\YAMLOpenApiRenderer;
use OpenApi\Annotations\OpenApi;
use PHPUnit\Framework\TestCase;

class YAMLOpenApiRendererTest extends TestCase
{
    public function testRender(): void
    {
        $renderer = new YAMLOpenApiRenderer();
        $open_api_mock = $this->createMock(OpenApi::class);
        $open_api_mock->expects($this->once())
            ->method('toYaml')
            ->willReturn('yaml_data');
        $json = $renderer->render($open_api_mock);
        $this->assertEquals('yaml_data', $json);
    }

    public function testGetFormat()
    {
        $renderer = new YAMLOpenApiRenderer();
        $this->assertEquals(RenderOpenApi::YAML, $renderer->getFormat());
    }
}
