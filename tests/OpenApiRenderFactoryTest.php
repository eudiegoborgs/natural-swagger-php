<?php declare(strict_types=1);

namespace Tests;

use Diegoborgs\NaturalSwaggerPhp\OpenApiRenderFactory;
use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;
use PHPUnit\Framework\TestCase;

class OpenApiRenderFactoryTest extends TestCase
{
    public function testGet()
    {
        $render = OpenApiRenderFactory::get();
        $this->assertInstanceOf(RenderOpenApi::class, $render);
        $this->assertEquals([
            RenderOpenApi::HTML,
            RenderOpenApi::JSON,
            RenderOpenApi::YAML
        ], $render->getAvailableFormats());
    }
}
