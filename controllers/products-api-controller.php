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
        $page = isset($_GET["page"]) ? $_GET["page"] : null;
        $per_page = isset($_GET["per_page"]) ? $_GET["per_page"] : null;
        $categoria = isset($_GET["categoria"]) ? $_GET["categoria"] : null;
        $products = $this->model->getAll($page, $per_page,$categoria);
        $this->view->response($products);
        }

    public function getProduct($params = null) {
        $id = $params[':ID'];
        $product = $this->model->get($id);
        if ($product)
            $this->view->response($product);
        else 
            $this->view->response("El producto con el id=$id no existe", 404);
        }

    public function deleteProduct($params = null) {
        $id = $params[':ID'];
        $product = $this->model->get($id);
        if ($product) {
            $this->model->delete($id);
            $this->view->response("El producto se eliminó con éxito con el id=$id", 201);
        } else 
            $this->view->response("El producto con el id=$id no existe", 404);
        }

    public function insertProduct($params = null) {
        $product = $this->getData();

        if (empty($product->nombre) || empty($product->categoria) || empty($product->cantidad)|| empty($product->marca)|| empty($product->vendido)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($product->nombre, $product->categoria, $product->cantidad, $product->marca, $product->vendido);
            $this->view->response("El producto se insertó con éxito con el id=$id", 201);
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
                $this->view->response("El producto se editó con éxito con el id=$id", 201);
            }
        }else 
            $this->view->response("El producto con el id=$id no existe", 404);
    
        }




}
