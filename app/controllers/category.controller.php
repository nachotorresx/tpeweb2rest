<?php

require_once './app/models/category.model.php';
require_once './app/views/category.view.php';

class CategoryController {
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new CategoryModel();
        $this->view = new CategoryView($res->user);
    }

    public function showCategorys() {
        $categorys = $this->model->getCategorys();
        return $this->view->showCategorys($categorys);
    }

    public function showProductsByCategory($nameCategory){
        $categorys = $this->model->getCategorys();
        $products = $this->model->getProductsByCategory($nameCategory);
        return $this->view->showProductsByCategory($products, $nameCategory);     
    }

    public function addCategory() {

        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Falta completar la descripcion');
        }
        if (!isset($_POST['URL_imagen']) || empty($_POST['URL_imagen'])) {
            return $this->view->showError('Falta completar la URL de la imagen');
        }
    
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $URL_imagen = $_POST['URL_imagen'];
    
        $id = $this->model->insertCategory($nombre, $descripcion, $URL_imagen);
    
        // redirijo al home
        header('Location: ' . BASE_URL);
       
    }

    public function editCategory($id) {
        // Verificar si se está realizando una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $URL_imagen = $_POST['URL_imagen'];
            
            // Validar los datos según sea necesario
            if ($this->model->updateCategory($nombre, $descripcion, $URL_imagen, $id)) {
                header('Location: ' . BASE_URL); // Redirigir después de la edición
            } else {
                return $this->view->showError("No se pudo actualizar la categoria.");
            }
        } else {
            // Si no es una solicitud POST, obtener los datos del producto
            $categorys = $this->model->getCategorys($id);
            return $this->view->mostrarFormularioEdicion($categorys);
        }
    }

    
    public function deleteCategory($id) {
        // Verifica si la categoría existe
        $category = $this->model->getCategory($id);
    
        if (!$category) {
            return $this->view->showError("No existe la categoría con el id=$id");
        }
    
        // Verifica si la categoría tiene productos asociados
        $hasProducts = $this->model->hasProducts($id);
    
        if ($hasProducts) {
            return $this->view->showError("No puedes eliminar esta categoría porque tiene productos asociados.");
        }
    
        // Si no tiene productos asociados, se puede eliminar
        $this->model->eraseCategory($id);
        header('Location: ' . BASE_URL);
    }
}
    
