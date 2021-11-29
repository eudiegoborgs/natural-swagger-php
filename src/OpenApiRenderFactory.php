<?php declare(strict_types=1);

namespace Diegoborgs\NaturalSwaggerPhp;

use Diegoborgs\NaturalSwaggerPhp\Renders\HTMLOpenApiRenderer;
use Diegoborgs\NaturalSwaggerPhp\Renders\JSONOpenApiRenderer;
use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;
use Diegoborgs\NaturalSwaggerPhp\Renders\YAMLOpenApiRenderer;
use Psr\Log\LoggerInterface;
use OpenApi\Generator;

class OpenApiRenderFactory
{
    private Generator $generator;

    public function __construct(LoggerInterface $logger)
    {
        $this->generator = new Generator($logger);
    }

    public function get(): RenderOpenApi
    {
        return new RenderOpenApi(
            $this->generator,
            new HTMLOpenApiRenderer(),
            new JSONOpenApiRenderer(),
            new YAMLOpenApiRenderer()
        );
    }
}
