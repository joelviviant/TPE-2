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

        if (empty($product->nombre) || empty($product->categoria) || empty($product->cantidad)|| empty($product->marca)|| empty($product->vendido)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($product->nombre, $product->categoria, $product->cantidad, $product->marca, $product->vendido);
            $this->view->response("La tarea se insertó con éxito con el id=$id", 201);
        }
        }

    public function updateProduct($params = null){
        $data = $this->getData();
        $id = $params[':ID'];
        $product = $this->model->get($id);
        if ($product) {
            if (empty($data->nombre) || empty($data->categoria) || empty($data->cantidad)|| empty($data->marca)|| empty($data->vendido)) {
                $this->view->response("Complete los datos", 400);
            } else {
                $this->model->editProduct($id,$data->nombre,$data->categoria, $data->cantidad, $data->marca, $data->vendido);
                $this->view->response("La tarea se editó con éxito con el id=$id", 201);
            }
        }else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    
        }


    public function updateVendido($params = null){
            $data = $this->getData();
            $id = $params[':ID'];
            $product = $this->model->get($id);
            if ($product) {
                if (empty($data->vendido)){
                    $this->view->response("Complete los datos", 400);
                } else {
                    $this->model->editVendido($id,$data->vendido);
                    $this->view->response("La tarea se editó con éxito con el id=$id", 201);
                }
            }else 
                $this->view->response("La tarea con el id=$id no existe", 404);
        
    
        }

}