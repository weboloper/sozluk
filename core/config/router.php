<?php

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group as RouterGroup;

$router = new Router(false);
$router->removeExtraSlashes(true);

$router->setDefaultModule("frontend");
$router->setDefaultController('error');
$router->setDefaultAction('show404');



// $router->add('/:controller/:action', [
//     'module'     => 'frontend',
//     'controller' => 1,
//     'action'     => 2,
// ])->setName('frontend');

// $router->add("/login", [
//     'module'     => 'backend',
//     'controller' => 'login',
//     'action'     => 'index',
// ])->setName('backend-login');

$router->add("/", [
    'module'     => 'frontend',
    'controller' => 'posts',
    'action'     => 'index',
]);
$router->add("/{feed:(newposts|newentries)}", [
    'module'     => 'frontend',
    'controller' => 'posts',
    'action'     => 'index',
]);

$frontend = new RouterGroup([
    'module'     => 'frontend',
    'controller' => 'posts',
    'action'     => 'index',
    'namespace'  => 'Weboloper\Frontend\Controllers',
]);

$frontend->add('/:controller/:action/:params', [
    'controller' => 1,
    'action'     => 2,
    'params'     => 3,
]);

$frontend->add('/:controller/:int', [
    'controller' => 1,
    'id'         => 2,
]);

$frontend->add('/:controller/:int/{slug}', [
    'controller' => 1,
    'id'         => 2,
    'slug'       => 3,
    'action'     => 'view'
]);

$frontend->add('/posts/:int/{slug}', [
    'controller' => 'posts',
    'id'     => 1,
    'slug'   => 2,
    'action' => 'view'
]);
$frontend->add('/posts/:int', [
    'controller' => 'posts',
    'id'     => 1,
    'slug'   => 2,
    'action' => 'view'
]);

$frontend->add('/{slug:[a-z0-9\-]+}--{id:[0-9]+}', [
    'controller' => 'posts',
    'id'     => 2,
    'slug'   => 1,
    'action' => 'view'
])->setName('postView');


$frontend->add('/entry/{id:[0-9]+}', [
    'controller' => 'entries',
    'id'     => 1,
    'action' => 'view'
])->setName('entryView');


$router->mount($frontend);




$backend = new RouterGroup([
    'module'     => 'backend',
    'controller' => 'dashboard',
    'action'     => 'index',
    'namespace'  => 'Weboloper\Backend\Controllers',
]);

$backend->add('/backend/:controller/:action/:params', [
    'controller' => 1,
    'action'     => 2,
    'params'     => 3,
]);

$backend->add('/backend/:controller/:action', [
    'controller' => 1,
    'action'     => 2,
]);

$backend->add('/backend/:controller/:int', [
    'controller' => 1,
    'id'         => 2,
]);

$backend->add('/backend/:controller', [
    'controller' => 1,
]);

$backend->add('/backend[/]?', [
    'controller' => 'dashboard',
]);

$router->mount($backend);


// $router->add("/products/:action", [
//     'module'     => 'frontend',
//     'controller' => 'products',
//     'action'     => 1,
// ])->setName('frontend-product');

return $router;
 