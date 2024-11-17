<?php
require_once 'app/models/model.php';

class ProductModel extends Model {
 
    public function getProducts($orderBy = false, $direccion = " ASC", $pagina, $limite, $filtro, $valor) {
        $sql = 'SELECT * FROM producto';
        $params = [];  // Arreglo para almacenar los parámetros de la consulta
        
        // Ordenamiento Ascendente/Descendente
        if ($orderBy) {
            switch ($orderBy) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre';
                    break;
                case 'descripcion':
                    $sql .= ' ORDER BY descripcion';
                    break;
                case 'precio':
                    $sql .= ' ORDER BY precio';
                    break;
            }
            if ($direccion === 'DESC') {
                $sql .= ' DESC';
            } else {
                $sql .= ' ASC';
            }
        }

        // Agregar el filtro si es necesario
        if ($filtro && $valor) {
            $sql .= " WHERE $filtro LIKE :valor";
            $params[':valor'] = "%" . $valor . "%";  // Agregar el valor con comodines
        }

        // Paginación
        if ($pagina && $limite) {
            $desplazamiento = ($pagina - 1) * $limite;
            $sql .= ' LIMIT :limite OFFSET :desplazamiento';
            $params[':limite'] = $limite;  // Asignar el valor de limite
            $params[':desplazamiento'] = $desplazamiento;  // Asignar el valor de desplazamiento
        }

        // Preparar y ejecutar la consulta
        $query = $this->db->prepare($sql);

        // Asociar los valores de los parámetros
        if ($filtro && $valor) {
            $query->bindParam(':valor', $params[':valor']);
        }
        if ($pagina && $limite) {
            $query->bindParam(':limite', $params[':limite'], PDO::PARAM_INT);
            $query->bindParam(':desplazamiento', $params[':desplazamiento'], PDO::PARAM_INT);
        }

        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ); 
        
        return $products;
    }
 
    public function getProduct($id) {    
        $query = $this->db->prepare('SELECT * FROM producto WHERE id_producto = ?');
        $query->execute([$id]);   
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
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
