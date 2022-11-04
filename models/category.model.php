<?php

class TaskModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_cart;charset=utf8', 'root', '');
    }

   
    public function getAll() {
  
        $query = $this->db->prepare( "select * from categoria ");
        $query -> execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories; 
    }

    public function get($id) {
        $query = $this->db->prepare( "select * from categoria WHERE id_categoria=?");
        $query -> execute(array($id));
        $category = $query->fetch(PDO::FETCH_OBJ);
        return $category; 
    }

    
    function insert($nombre){
        $sentencia = $this->db->prepare("INSERT INTO categoria(nombre) VALUES(?)");
        $sentencia->execute(array($nombre));
        return $this->db->lastInsertId();
    }

    function delete($id) {
        $query = $this->db->prepare("DELETE FROM categoria WHERE id_categoria=?");
        $query->execute(array($id));

    }

    function editCategory($id_categoria, $nombre){
        $sentencia = $this->db->prepare("UPDATE categoria SET nombre=? WHERE id_categoria=?");
        $sentencia->execute(array($nombre,$id_categoria));
    }

}
