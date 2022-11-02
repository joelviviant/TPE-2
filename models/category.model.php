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

    /**
     * Inserta una tarea en la base de datos.
     */
    public function insert($title, $description, $priority) {
        $query = $this->db->prepare("INSERT INTO task (titulo, descripcion, prioridad, finalizada) VALUES (?, ?, ?, ?)");
        $query->execute([$title, $description, $priority, false]);

        return $this->db->lastInsertId();
    }

    function delete($id) {
        $query = $this->db->prepare("DELETE FROM categoria WHERE id_categoria=?");
        $query->execute(array($id));

    }

    public function finalize($id) {
        $query = $this->db->prepare('UPDATE task SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
        // var_dump($query->errorInfo()); // y eliminar la redireccion
    }
}
