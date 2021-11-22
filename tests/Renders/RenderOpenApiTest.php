<?php declare(strict_types=1);

namespace Tests\Renders;

use Diegoborgs\NaturalSwaggerPhp\Renders\OpenApiRendererInterface;
use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;
use OpenApi\Annotations\OpenApi;
use OpenApi\Generator;
use OpenApi\Util;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

class RenderOpenApiTest extends TestCase
{
    public function testGetAvailableFormats(): void
    {
        $generatorMock = $this->createMock(Generator::class);
        $rendererHTML = $this->createMock(OpenApiRendererInterface::class);
        $rendererJSON = $this->createMock(OpenApiRendererInterface::class);
        $rendererYML = $this->createMock(OpenApiRendererInterface::class);
        $rendererHTML->expects($this->once())->method('getFormat')->willReturn(RenderOpenApi::HTML);
        $rendererJSON->expects($this->once())->method('getFormat')->willReturn(RenderOpenApi::JSON);
        $rendererYML->expects($this->once())->method('getFormat')->willReturn(RenderOpenApi::YAML);

        $render = new RenderOpenApi($generatorMock, $rendererHTML, $rendererJSON, $rendererYML);
        $this->assertEquals([
            RenderOpenApi::HTML,
            RenderOpenApi::JSON,
            RenderOpenApi::YAML
        ], $render->getAvailableFormats());
    }

    public function testRender(): void
    {
        \Mockery::mock(sprintf('alias:%s', Util::class))
            ->shouldReceive('finder')
            ->with('test_path', null, '*.php')
            ->andReturn($this->createMock(Finder::class));
        $rendererHTML = $this->createMock(OpenApiRendererInterface::class);
        $rendererHTML->expects($this->once())->method('getFormat')->willReturn(RenderOpenApi::HTML);
        $rendererHTML->expects($this->once())->method('render')->willReturn('test_is_success');

        $generatorMock = $this->createMock(Generator::class);
        $generatorMock->expects($this->any())
            ->method('generate')
            ->willReturn($this->createMock(OpenApi::class));

        $render = new RenderOpenApi($generatorMock, $rendererHTML);
        $this->assertEquals(
            'test_is_success',
            $render->render(RenderOpenApi::HTML, ['base_path' => 'test_path'])
        );
    }
}
