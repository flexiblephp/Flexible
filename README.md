# Flexible PHP micro framework

## Example

```php
<?php

use Flexible\App;
use Flexible\Http\ResponseFactory;
use Flexible\Http\ServerRequestFactory;

define('FLEXIBLE_START', microtime(true));

require __DIR__ . '/vendor/autoload.php';

$app = App::create();

$app->router()->get('/hello', function() {
    $response = (new ResponseFactory())->createResponse();
    $response->getBody()->write("Hello, world");

    return $response->withStatus(200);
});

$app->dispatch(
    $app->handle(ServerRequestFactory::fromGlobals())
);
```
