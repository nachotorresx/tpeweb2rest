<?php
require_once 'app/models/model.php';
class CategoryModel extends Model {
 
    public function getCategorys() {

        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();
    
        $categorys = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $categorys;
    }
 
    public function getCategory($id) {    
        $query = $this->db->prepare('SELECT * FROM categoria WHERE id_categoria = ?');
        $query->execute([$id]);   
    
        $categorys = $query->fetch(PDO::FETCH_OBJ);
    
        return $categorys;
    }

    public function getProductsByCategory($nameCategory) {    
        $query = $this->db->prepare('SELECT producto.id_producto, producto.nombre, producto.descripcion, producto.precio, producto.URL_imagen FROM producto JOIN categoria ON producto.id_categoria = categoria.id_categoria WHERE categoria.nombre = ?');
        $query->execute([$nameCategory]);
        
        $products = $query->fetchAll(PDO::FETCH_OBJ);    

        return $products;
    }
 
    public function insertCategory($nombre, $descripcion, $URL_imagen) { 
        $query = $this->db->prepare('INSERT INTO categoria(nombre, descripcion, URL_imagen) VALUES (?, ?, ?)');
        $query->execute([$nombre, $descripcion, $URL_imagen]);
    
        $id = $this->db->lastInsertId();

        return $id;
    }

    public function updateCategory($nombre, $descripcion, $URL_imagen, $id) {
        $stmt = $this->db->prepare("UPDATE categoria SET nombre = ?, descripcion = ?, URL_imagen = ? WHERE id_categoria = ?");

        return $stmt->execute([$nombre, $descripcion, $URL_imagen, $id]);
    }
    
    public function hasProducts($id_categoria) {
        $query = $this->db->prepare('SELECT COUNT(*) as count FROM producto WHERE id_categoria = ?');
        $query->execute([$id_categoria]);
        $result = $query->fetch(PDO::FETCH_OBJ);

        return $result->count > 0; // Retorna true si hay productos
    }
    
    public function eraseCategory($id) {
        $query = $this->db->prepare('DELETE FROM categoria WHERE id_categoria = ?');
        $query->execute([$id]);
    }
}