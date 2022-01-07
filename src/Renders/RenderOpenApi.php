<?php declare(strict_types=1);

namespace Diegoborgs\NaturalSwaggerPhp\Renders;

use OpenApi\Generator;

class RenderOpenApi
{
    public const HTML = 'html';
    public const JSON = 'json';
    public const YAML = 'yaml';

    public const PHP_PATTERN = "*.php";

    /**
     * @var array<string, OpenApiRendererInterface|null>
     */
    private array $renderers;

    public function __construct(OpenApiRendererInterface ...$renderers)
    {
        foreach ($renderers as $renderer) {
            $this->renderers[$renderer->getFormat()] = $renderer;
        }
    }

    public function getAvailableFormats(): array
    {
        return array_keys($this->renderers);
    }
    /**
     * @throws \InvalidArgumentException If the area to dump is not valid
     */
    public function render(string $format = RenderOpenApi::JSON, array $options = []): string
    {
        $options = array_merge([
            'base_path' => __DIR__
        ], $options);

        $spec = Generator::scan([$options['base_path']]);

        return $this->renderers[$format]->render($spec, $options);
    }
}
