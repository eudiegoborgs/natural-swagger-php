<?php declare(strict_types=1);

namespace Diegoborgs\NaturalSwaggerPhp\Renders;

use OpenApi\Annotations\OpenApi;

class JSONOpenApiRenderer implements OpenApiRendererInterface
{

    public function getFormat(): string
    {
        return RenderOpenApi::JSON;
    }

    public function render(OpenApi $spec, array $options = []): string
    {
        return $spec->toJson();
    }
}
