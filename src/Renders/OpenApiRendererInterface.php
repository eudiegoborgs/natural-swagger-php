<?php declare(strict_types=1);

namespace Diegoborgs\NaturalSwaggerPhp\Renders;

use OpenApi\Annotations\OpenApi;

/**
 * @internal
 */
interface OpenApiRendererInterface
{
    public function getFormat(): string;

    public function render(OpenApi $spec, array $options = []): string;
}
