<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Generator\UrlGenerator;

//Important to load classes, controllers etc
require dirname(__DIR__). '/vendor/autoload.php';


require  dirname(__DIR__). '/config.php';

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$urlGenerator = new UrlGenerator($routes,new RequestContext());

try {
    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);

    ob_start();
    include sprintf(__DIR__.'/../view/%s.php', $_route);
    $response = new Response(ob_get_clean());
} catch (ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Exception $exception) {
    var_dump($exception);
    $response = new Response('An error occurred', 500);
}

$response->send();