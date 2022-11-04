<?php
require_once './models/category.model.php';
require_once './views/api.view.php';

class CategoryApiController {
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new TaskModel();
        $this->view = new ApiView();

        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
        }
    public function getCategories($params = null) {
        $categories = $this->model->getAll();
        $this->view->response($categories);
        }
        
    public function getCategory($params = null) {
        $id = $params[':ID'];
        $category = $this->model->get($id);
        if ($category)
            $this->view->response($category);
        else 
            $this->view->response("La categoria con el id=$id no existe", 404);
        }

    public function deleteCategory($params = null) {
        $id = $params[':ID'];
        $category = $this->model->get($id);
        if ($category) {
            $this->model->delete($id);
            $this->view->response("La categoría se eliminó con éxito con el id=$id", 201);
        } else 
            $this->view->response("La categoria con el id=$id no existe", 404);
        }
    public function insertCategory($params = null) {
            $category = $this->getData();
    
            if ( empty($category->nombre)) {
                $this->view->response("Complete los datos", 400);
            } else {
                $id = $this->model->insert( $category->nombre);
                $this->view->response("La categoria se insertó con éxito con el id=$id", 201);
            }
        }
    public function editCategory($params = null){
            $data = $this->getData();
            $id = $params[':ID'];
            $category = $this->model->get($id);
            if ($category) {
                if (empty($data->nombre)) {
                    $this->view->response("Complete los datos", 400);
                } else {
                    $this->model->editCategory($id,$data->nombre);
                    $this->view->response("La categoría se editó con éxito con el id=$id", 201);
                }
            }else 
                $this->view->response("La categoría con el id=$id no existe", 404);
        
            }
}
