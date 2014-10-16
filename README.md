# Environ service provider

Environ service provider for Silex micro-framework

## Usage

```php
use Neemzy\Silex\Provider\EnvironServiceProvider;
use Neemzy\Environ\Environment;

$app = new Silex\Application();

$app->register(
    new EnvironServiceProvider(
        [
            'env' => new Environment(
                function () {
                    // condition closure
                },
                function () {
                    // callback closure
                }
            )
        ]
    ),
);

$app->run();
```
