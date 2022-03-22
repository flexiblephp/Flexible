<?php

declare(strict_types=1);

namespace Flexible\Http;

use Nyholm\Psr7\ServerRequest as NyholmServerRequest;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequest extends NyholmServerRequest implements ServerRequestInterface
{

}
