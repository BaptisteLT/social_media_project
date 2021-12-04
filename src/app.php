<?php

use App\controller\HelloController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


// example.com/src/app.php

$routes = new RouteCollection();
//$routes->add('hello', new Route('/hello/{name}', [HelloController::class,'hello'],['name'=>'[A-Za-z]+']));
$routes->add('index', new Route('/'));
//$routes->add('new-tache', new Route('/new-tache'));
$routes->add('login', new Route('/login'));
$routes->add('register', new Route('/register'));
//$routes->add('view-tache', new Route('/view-tache/{id<\d+>?100}'),[],[],[],'www.monsite.fr'); permet de dire que seul monsite peut accéder
//$routes->add('view-tache', new Route('/view-tache/{id}'));

/*API*/
$routes->add('createPostApi', new Route('/create-post-api'));
$routes->add('likePostApi', new Route('/like-post-api'));

return $routes;