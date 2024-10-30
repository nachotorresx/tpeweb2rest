<?php
require_once './app/models/product.model.php';

require_once './app/views/json.view.php';

class ProductController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new ProductModel();
        $this->view = new JSONView();
    }

    public function getProducts($req, $res) {

        $products = $this->model->getProducts();
        
        return $this->view->response($products);
    }

    public function getProduct($req, $res) {

        $id = $req->params->id;

        $product = $this->model->getProduct($id);
        
        if(!$product) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }
        return $this->view->response($product);
    }

    public function addProduct($req, $res) {

        if (empty($req->body->nombre) || empty($req->body->descripcion) || empty($req->body->precio) || empty($req->body->id_categoria) || empty($req->body->URL_imagen)) {
            return $this->view->response('Falta completar datos', 404);
        }

        $nombre = $req->body->nombre;
        $descripcion = $req->body->descripcion;
        $precio = $req->body->precio;
        $categoria = $req->body->id_categoria;
        $URL_imagen = $req->body->URL_imagen;

        $id = $this->model->insertProduct($nombre, $descripcion, $precio, $categoria, $URL_imagen);
        
        if (!$id) {
            return $this->view->response("Error al insertar producto", 500);
        }
        $product = $this->model->getProduct($id);
        return $this->view->response($product, 201);
    }

    public function editProduct($req, $res) {
        $id = $req->params->id;

        // verifico que exista
        $product = $this->model->getProduct($id);
        if (!$product) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        if (empty($req->body->nombre) || empty($req->body->descripcion) || empty($req->body->precio) 
            || empty($req->body->id_categoria) || empty($req->body->URL_imagen)) {
            return $this->view->response('Falta completar datos', 404);
        }

        $nombre = $req->body->nombre;
        $descripcion = $req->body->descripcion;
        $precio = $req->body->precio;
        $categoria = $req->body->id_categoria;
        $URL_imagen = $req->body->URL_imagen;

        $this->model->updateProduct($id, $nombre, $descripcion, $precio, $categoria, $URL_imagen);
        $product = $this->model->getProduct($id);
        return $this->view->response($product, 201);
    }

    public function deleteProduct($req, $res) {

        $id = $req->params->id;

        $product = $this->model->getProduct($id);

        if (!$product) {
            return $this->view->response("No existe el producto con el id=$id", 404);
        }
        $this->model->eraseProduct($id);
        $this->view->response("La tarea con el id=$id se eliminó con éxito", 200);
        //header('Location: ' . BASE_URL);
    }
}

