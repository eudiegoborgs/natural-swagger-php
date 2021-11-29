<?php declare(strict_types=1);

namespace Tests\Renders;

use Diegoborgs\NaturalSwaggerPhp\Renders\HTMLOpenApiRenderer;
use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;
use OpenApi\Annotations\OpenApi;
use PHPUnit\Framework\TestCase;

class HTMLOpenApiRendererTest extends TestCase
{
    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    public function testRender(): void
    {
        $expected_html = file_get_contents(dirname(__FILE__) . '/../TestAssets/html_open_api_renderer_test_render.html');
        $renderer = new HTMLOpenApiRenderer();
        $open_api_mock = $this->createMock(OpenApi::class);
        $open_api_mock->expects($this->once())
            ->method('toJson')
            ->willReturn('{"data": "value"}');
        $html = $renderer->render($open_api_mock);
        $this->assertEquals($expected_html, $html);
    }

    public function testGetFormat()
    {
        $renderer = new HTMLOpenApiRenderer();
        $this->assertEquals(RenderOpenApi::HTML, $renderer->getFormat());
    }
}
