<?php
    
    
    require_once 'libs/router.php';

    require_once 'app/controllers/product.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';
    require_once 'app/middlewares/jwt.auth.middleware.php';

    $router = new Router();

    #                 endpoint                    verbo      controller             metodo
    $router->addRoute('productos'   ,               'GET',     'ProductController',   'getProducts');
    $router->addRoute('productos/:id'  ,            'GET',     'ProductController',   'getProduct');
    $router->addRoute('productos/:id'  ,            'DELETE',  'ProductController',   'deleteProduct');
    $router->addRoute('productos'  ,                'POST',    'ProductController',   'addProduct');
    $router->addRoute('productos/:id'  ,            'PUT',     'ProductController',   'editProduct');
    $router->addRoute('usuarios/test'    ,            'GET',     'UserApiController',   'getTest');

    $router->addRoute('usuarios/token'    ,            'GET',     'UserApiController',   'getToken');
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);