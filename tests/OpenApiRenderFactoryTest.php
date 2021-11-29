<?php declare(strict_types=1);

namespace Tests;

use Diegoborgs\NaturalSwaggerPhp\OpenApiRenderFactory;
use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class OpenApiRenderFactoryTest extends TestCase
{

    public function testGet()
    {
        $factory = new OpenApiRenderFactory($this->createMock(LoggerInterface::class));
        $render = $factory->get();
        $this->assertInstanceOf(RenderOpenApi::class, $render);
        $this->assertEquals([
            RenderOpenApi::HTML,
            RenderOpenApi::JSON,
            RenderOpenApi::YAML
        ], $render->getAvailableFormats());
    }
}
