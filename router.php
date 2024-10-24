<?php
    
    require_once 'libs/router.php';

    require_once 'app/controllers/product.api.controller.php';

    $router = new Router();

    #                 endpoint                    verbo      controller             metodo
    $router->addRoute('productos'   ,               'GET',     'ProductController',   'getProducts');
    $router->addRoute('productos/:id'  ,            'GET',     'ProductController',   'getProduct');
    $router->addRoute('productos/:id'  ,            'DELETE',  'ProductController',   'delete');
    $router->addRoute('productos'  ,                'POST',    'ProductController',   'create');
    $router->addRoute('productos/:id'  ,            'PUT',     'ProductController',   'update');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);