<?php
require_once 'models/productsModel.php';
require_once 'api/ApiView.php';

class ApiProductController{
    private $model;
    private $view;
    private $data;
    
    function __construct(){

        $this->model = new ProductsModel();
        $this->view = new ApiView();
     }
    
    public function getAll($paramas = null){
        $products = $this->model->getAllProducts();
        $this->view->response($products);
        
    }

    public function getOne($params = null){
        $id = $params[':ID'];
        $product = $this->model->getProduct($id);
        if ($product)
            $this->view->response($product);
        else
            $this->view->response("producto id =  $id not Found", 404);
        
    }

    public function remove($params = null){
        $id = $params[':ID'];
      
        $product = $this->model->getProduct($id);

        if ($product){
            $this->model->deleteProduct($id);
            $this->view->response("producto id =  $id remove successfuly");    
        }   
        else
            $this->view->response("producto id =  $id not Found", 404);
        
    }
    
    private function getBody() { //transforma el texto bruto en json
        $data = file_get_contents("php://input");
        return json_decode($data);
    }
    
    public function add($params = null) {
        $data = $this->getBody();

        $productName = $data->name;
        $productSize = $data->size;
        $productPrice = $data->price;
        $category_id = $data->category_id;

        $id = $this->model->insertProduct($productName, $productSize, $productPrice, $category_id);//inserta el producto
        
        $product = $this->model->getProduct($id); //trae el producto
        
        if ($product) // si existe, si se inserto
            $this->view->response($product, 200); // devuelve el producto con OK
        else
            $this->view->response("La tarea no fue creada", 500);
    }
/*
    public function updateProduct($params = null) {//modifica producto
        $id = $params[':ID'];
        $data = $this->getBody();
        $product = $this->model->getProduct($id);
        
        if ($product){
            $this->model->updateProduct($id , $data->name, $data->price, $data->size, $data->category_id);//modifico
            $this->view->response("El producto id = $id fue modificado con exito", 200);
        }
        else
            $this->view->response("Product id = $id Not Found", 404);
    }
*/
}
