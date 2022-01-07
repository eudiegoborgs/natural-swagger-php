# NaturalSwagger (PHP) 

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/eudiegoborgs/natural-swagger-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/eudiegoborgs/natural-swagger-php/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/eudiegoborgs/natural-swagger-php/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Total Downloads](https://img.shields.io/packagist/dt/eudiegoborgs/natural-swagger-php.svg)](https://packagist.org/packages/eudiegoborgs/natural-swagger-php)

The NaturalSwagger allows you to generate a decent documentation for your APIs. This library is based on [zircote/swagger-php](https://github.com/zircote/swagger-php) and [swagger-ui](https://github.com/swagger-api/swagger-ui).

This library provide for your system a swagger UI based 

## How to use

#### Install with composer:
```sh
composer require eudiegoborgs/natural-swagger-php
```

#### Add to your code:
```php
use Diegoborgs\NaturalSwaggerPhp\OpenApiRenderFactory;
use Diegoborgs\NaturalSwaggerPhp\Renders\RenderOpenApi;

$render = OpenApiRenderFactory::get();
$render->render(RenderOpenApi::HTML,  ['base_path' => '/path/to/annotations']);
```

## Contributing

Fork the project and send your PR.

## Running the Tests

Install the [Composer](http://getcomposer.org/) dependencies:
```
git clone https://github.com/eudiegoborgs/natural-swagger-php.git
cd natural-swagger-php
docker-compose run --rm composer update 
// or
composer update
```

Then run the test suite:
```
docker-compose run --rm composer test 
// or
composer test
```

## License

This bundle is released under the MIT license.