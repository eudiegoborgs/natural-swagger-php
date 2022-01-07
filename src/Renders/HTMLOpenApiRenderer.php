<?php declare(strict_types=1);

namespace Diegoborgs\NaturalSwaggerPhp\Renders;

use OpenApi\Annotations\OpenApi;
use Twig\Loader\FilesystemLoader;

class HTMLOpenApiRenderer implements OpenApiRendererInterface
{
    private const BASE_ASSETS = "https://cdn.jsdelivr.net/gh/eudiegoborgs/natural-swagger-php/src/Resources/assets";

    private \Twig\Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(dirname(__FILE__) . '/../Resources/Views');
        $this->twig = new \Twig\Environment($loader);
    }

    public function getFormat(): string
    {
        return RenderOpenApi::HTML;
    }

    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    public function render(OpenApi $spec, array $options = []): string
    {
        return $this->twig->render(
            'SwaggerUi/swagger.html.twig',
            array_merge_recursive(
                $options,
                [
                    'swagger_data' => ['spec' => json_decode($spec->toJson(), true)],
                    'base_assets' => self::BASE_ASSETS
                ]
            )
        );
    }
}
