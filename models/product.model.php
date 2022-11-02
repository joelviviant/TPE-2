<?php

class ProductModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_cart;charset=utf8', 'root', '');
    }

    public function getAll() {
        $query = $this->db->prepare( "select p.id,p.nombre,p.marca,p.cantidad,p.vendedor, c.nombre as categoria,c.id_categoria from producto p join categoria c on p.categoria=c.id_categoria");
        $query -> execute();
        $products = $query->fetchALL(PDO::FETCH_OBJ); 
        return $products; 
    }

    public function get($id) {
        $query = $this->db->prepare( "select p.id,p.nombre,p.marca,p.cantidad,p.vendedor, c.nombre as categoria,c.id_categoria from producto p join categoria c on p.categoria=c.id_categoria  WHERE id=?");
        $query -> execute(array($id));
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product; 
    }

    /**
     * Inserta una tarea en la base de datos.
     */
    public function insert($nombre, $categoria, $cantidad, $marca, $vendedor) {
        $query = $this->db->prepare("INSERT INTO producto (nombre, categoria, cantidad, marca, vendedor) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$nombre, $categoria, $cantidad, $marca, $vendedor]);
        return $this->db->lastInsertId();
    }


    /**
     * Elimina una tarea dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare("DELETE FROM producto WHERE id=?");
        $query->execute(array($id,));
    }

    public function finalize($id) {
        $query = $this->db->prepare('UPDATE task SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
        // var_dump($query->errorInfo()); // y eliminar la redireccion
    }
}
