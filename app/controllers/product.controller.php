<?php
require_once './app/models/product.model.php';
require_once './app/views/product.view.php';

class ProductController {
    private $model;
    private $view;
    private $modeloCategoria;

    public function __construct($res) {
        $this->model = new ProductModel();
        $this->view = new ProductView($res->user);
        $this->modeloCategoria = new CategoryModel();
    }

    public function showProducts() {
        $products = $this->model->getProducts();
        
        $categorys = $this->modeloCategoria->getCategorys();

        return $this->view->showProducts($products, $categorys);
    }

    public function showProduct($id){
        $product = $this->model->getProduct($id);
        $categorys = $this->modeloCategoria->getCategorys();
        return $this->view->showProduct($product, $categorys);
    }

    public function addProduct() {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Falta completar la descripcion');
        }
        if (!isset($_POST['precio']) || empty($_POST['precio'])) {
            return $this->view->showError('Falta completar el precio');
        }
        if (!isset($_POST['id_categoria']) || empty($_POST['id_categoria'])) {
            return $this->view->showError('Falta completar el categoria');
        }
        if (!isset($_POST['URL_imagen']) || empty($_POST['URL_imagen'])) {
            return $this->view->showError('Falta completar la URL de la imagen');
        }

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $categoria = $_POST['id_categoria'];
        $URL_imagen = $_POST['URL_imagen'];

        $id = $this->model->insertProduct($nombre, $descripcion, $precio, $categoria, $URL_imagen);
        // redirijo al home
        header('Location: ' . BASE_URL);
    }

    public function editProduct($id) {
        // Verificar si se está realizando una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $URL_imagen = $_POST['URL_imagen'];
            // Validar los datos según sea necesario
            if ($this->model->updateProduct($nombre, $descripcion, $precio, $URL_imagen, $id)) {
                header('Location: ' . BASE_URL); // Redirigir después de la edición
            } else {
                return $this->view->showError("No se pudo actualizar el producto.");
            }
        } 
    }

    public function deleteProduct($id) {
        $product = $this->model->getProduct($id);
        if (!$product) {
            return $this->view->showError("No existe el producto con el id=$id");
        }
        $this->model->eraseProduct($id);
        header('Location: ' . BASE_URL);
    }
}

