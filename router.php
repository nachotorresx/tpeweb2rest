<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/product.controller.php';
require_once 'app/controllers/category.controller.php';
require_once 'app/controllers/auth.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'home'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new ProductController($res);
        $controller->showProducts();
        break;
    case 'productos':
        $controller = new ProductController($res);
        $controller->showProduct($params[1]);
        break;
    case 'categorias':
        sessionAuthMiddleware($res); 
        $controller = new CategoryController($res);
        if(isset($params[1])){
            $controller->showProductsByCategory($params[1]);
        }
        else {
        $controller->showCategorys();
        }
        break;
    case 'nuevo_producto':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ProductController($res);
        $controller->addProduct();
        break;
    case 'eliminar_producto':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ProductController($res);
        $controller->deleteProduct($params[1]);
        break;
    case 'editar_producto':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ProductController($res);
        $controller->editProduct($params[1]);
        break;
    case 'nueva_categoria':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new CategoryController($res);
        $controller->addCategory();
    break;
    case 'eliminar_categoria':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new CategoryController($res);
        $controller->deleteCategory($params[1]);
        break;
    case 'editar_categoria':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new CategoryController($res);
        $controller->editCategory($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
    default: 
        echo "404 Page Not Found";
        break;
}