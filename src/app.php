<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


// example.com/src/app.php

$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', ['name' => 'World']));
$routes->add('taches-list', new Route('/taches-list'));

return $routes;