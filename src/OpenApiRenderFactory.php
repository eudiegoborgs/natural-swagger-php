<?php declare(strict_types=1);

namespace Diegoborgs\NaturalSwaggerPhp;

use Diegoborgs\NaturalSwaggerPhp\Renders\HTMLOpenApiRenderer;
use Diegoborgs\NaturalSwaggerPhp\Renders\JSONOpenApiRenderer;
use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;
use Diegoborgs\NaturalSwaggerPhp\Renders\YAMLOpenApiRenderer;

class OpenApiRenderFactory
{
    public static function get(): RenderOpenApi
    {
        return new RenderOpenApi(
            new HTMLOpenApiRenderer(),
            new JSONOpenApiRenderer(),
            new YAMLOpenApiRenderer()
        );
    }
}
