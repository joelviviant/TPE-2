<?php
require_once './models/product.model.php';
require_once './views/api.view.php';

class   ProductApiController {
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new ProductModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getProducts($params = null) {
        $products = $this->model->getAll();
        $this->view->response($products);
    }

    public function getProduct($params = null) {
        $id = $params[':ID'];
        $product = $this->model->get($id);
        if ($product)
            $this->view->response($product);
        else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function deleteProduct($params = null) {
        $id = $params[':ID'];

        $product = $this->model->get($id);
        if ($product) {
            $this->model->delete($id);
            $this->view->response($product);
        } else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function insertProduct($params = null) {
        $product = $this->getData();

        if (empty($product->nombre) || empty($product->categoria) || empty($product->cantidad)|| empty($product->marca)|| empty($product->vendedor)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($product->nombre, $product->categoria, $product->cantidad, $product->marca, $product->vendedor);
            $this->view->response("La tarea se insertó con éxito con el id=$id", 201);
        }
    }

}