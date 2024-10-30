<?php
require_once 'app/models/model.php';

class ProductModel extends Model {
 
    public function getProducts() {
        $query = $this->db->prepare('SELECT * FROM producto');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $products;
    }
 
    public function getProduct($id) {    
        $query = $this->db->prepare('SELECT * FROM producto WHERE id_producto = ?');
        $query->execute([$id]);   
    
        $products = $query->fetch(PDO::FETCH_OBJ);
    
        return $products;
    }
 
    public function insertProduct($nombre, $descripcion, $precio, $categoria, $URL_imagen) { 
        $query = $this->db->prepare('INSERT INTO producto(nombre, descripcion, precio, id_categoria, URL_imagen) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $descripcion, $precio, $categoria, $URL_imagen]);
    
        $id = $this->db->lastInsertId();

        return $id;
    }

    public function updateProduct($id, $nombre, $descripcion, $precio, $categoria, $URL_imagen) {
        $stmt = $this->db->prepare("UPDATE producto SET nombre = ?, descripcion = ?, precio = ?, id_categoria = ?, URL_imagen = ? WHERE id_producto = ?");
        return $stmt->execute([$nombre, $descripcion, $precio, $categoria, $URL_imagen, $id]); 
    }
 
    public function eraseProduct($id) {
        $query = $this->db->prepare('DELETE FROM producto WHERE id_producto = ?');
        $query->execute([$id]);
    }
}