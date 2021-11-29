<?php declare(strict_types=1);

namespace Diegoborgs\NaturalSwaggerPhp\Renders;

use OpenApi\Generator;
use OpenApi\Util;

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

    private Generator $generator;

    public function __construct(Generator $generator, OpenApiRendererInterface ...$renderers)
    {
        foreach ($renderers as $renderer) {
            $this->renderers[$renderer->getFormat()] = $renderer;
        }
        $this->generator = $generator;
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
        $spec = $this->generator->generate(Util::finder($options['base_path'], null, self::PHP_PATTERN));

        return $this->renderers[$format]->render($spec, $options);
    }
}
