<?php declare(strict_types=1);

namespace Diegoborgs\NaturalSwaggerPhp\Renders;

use OpenApi\Annotations\OpenApi;

class YAMLOpenApiRenderer implements OpenApiRendererInterface
{

    public function getFormat(): string
    {
        return RenderOpenApi::YAML;
    }

    public function render(OpenApi $spec, array $options = []): string
    {
        return $spec->toYaml();
    }
}
