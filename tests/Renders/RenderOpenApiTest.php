<?php declare(strict_types=1);

namespace Tests\Renders;

use Diegoborgs\NaturalSwaggerPhp\Renders\OpenApiRendererInterface;
use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;
use OpenApi\Annotations as OA;
use OpenApi\Generator;
use PHPUnit\Framework\TestCase;

class RenderOpenApiTest extends TestCase
{
    public function testGetAvailableFormats(): void
    {
        $rendererHTML = $this->createMock(OpenApiRendererInterface::class);
        $rendererJSON = $this->createMock(OpenApiRendererInterface::class);
        $rendererYML = $this->createMock(OpenApiRendererInterface::class);
        $rendererHTML->expects($this->once())->method('getFormat')->willReturn(RenderOpenApi::HTML);
        $rendererJSON->expects($this->once())->method('getFormat')->willReturn(RenderOpenApi::JSON);
        $rendererYML->expects($this->once())->method('getFormat')->willReturn(RenderOpenApi::YAML);

        $render = new RenderOpenApi($rendererHTML, $rendererJSON, $rendererYML);
        $this->assertEquals([
            RenderOpenApi::HTML,
            RenderOpenApi::JSON,
            RenderOpenApi::YAML
        ], $render->getAvailableFormats());
    }

    /**
     * @OA\OpenApi(
     *    @OA\Info(
     *       version="1.0.0",
     *       title="Swagger UI",
     *       description="Swagger UI",
     *       @OA\Contact(
     *           name="Diego Borges",
     *           url="test.com",
     *           email="test@test.com",
     *       ),
     *       @OA\License(
     *           name="Apache 2.0",
     *           url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *       ),
     *       @OA\ExternalDocumentation(
     *           description="Find out more about Swagger",
     *           url="http://swagger.io"
     *       ),
     *    ),
     *    @OA\Server(
     *       url="https://api.example.com/v1",
     *       description="Example API"
     *    ),
     *    @OA\Server(
     *       url="https://api.example.com/v2",
     *       description="Example API"
     *    ),
     *    @OA\Get(
     *       path="/test",
     *       tags={"Test"},
     *       summary="Test",
     *       description="Test",
     *       operationId="test",
     *       @OA\Parameter(
     *           name="test",
     *           in="query",
     *           description="Test",
     *           required=true,
     *           @OA\Schema(
     *               type="string"
     *           )
     *       ),
     *       @OA\Response(
     *           response=200,
     *           description="successful operation",
     *           @OA\JsonContent(
     *               type="array",
     *               @OA\Items(
     *                   type="object",
     *                   @OA\Property(
     *                       property="test",
     *                       type="string"
     *                   )
     *               )
     *           )
     *       )
     *    )
     * )
     */
    public function testRender(): void
    {
        $rendererHTML = $this->createMock(OpenApiRendererInterface::class);
        $rendererHTML->expects($this->once())->method('getFormat')->willReturn(RenderOpenApi::HTML);
        $rendererHTML->expects($this->once())->method('render')->willReturn('test_is_success');

        $render = new RenderOpenApi($rendererHTML);
        $this->assertEquals(
            'test_is_success',
            $render->render(RenderOpenApi::HTML, ['base_path' => __DIR__])
        );
    }

    public function testConstructWithNullRender()
    {
        $this->expectException(\TypeError::class);
        $render = new RenderOpenApi(null);
    }
}
