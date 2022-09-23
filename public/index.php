<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use App\Config\Routes;
use App\Controller\Product\ProductController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$routes = (new Routes())->exposerRoutes();

$context = new RequestContext();

$context->fromRequest(Request::createFromGlobals());

$matcher = new UrlMatcher($routes, $context);

try {
    $attributes = $matcher->match($context->getPathInfo());
    $controller = new ProductController;
    $action = $attributes['method'];
    $response = $controller->$action();

} catch (ResourceNotFoundException $exception) {
    $response = new Response('<html>
    <body><h1>404</h1>
    </div>
    <h2>Page not found</h2>
    <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
    <a href="/">home page</a>
    </div>
    </div></body></html>', 404);
} catch (\Exception $exception) {
    $response = new Response('
    <html>
    <body><h1>404</h1>
    </div>
    <h2>Page not found</h2>
    <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
    <a href="/">home page</a>
    </div>
    </div></body></html>',404);
}

$response->send();