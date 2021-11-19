<?php
require_once 'models/commentModel.php';
require_once 'views/apiView.php';

class ApiCommentController{
    private $model;
    private $view;
    
    function __construct(){

        $this->model = new CommentModel();
        $this->view = new ApiView();
     }

     private function getBody() { //transforma el texto bruto en json
        $data = file_get_contents("php://input");
        return json_decode($data);
    }

    public function getAll(){// para usar de prueba, trae todos los comentarios
        $comments = $this->model->getAll();
        var_dump($comments);

    }

     public function addComment($params = null) { //Agrega un comentario nuevo
        $data = $this->getBody();

        $comment = $data->comment;
        $core = $data->core;
        $id_product = $data->id_product;
        $id_user = $data->id_user;

        $id = $this->model->insertComment($comment, $core, $id_product, $id_user);
        
        $comment = $this->model->getOneComment($id); 
        
        if ($comment)
            $this->view->response($comment, 200);

            //llamar a la vista con $comment, insertar al final

        else
            $this->view->response("La tarea no fue creada", 500);
    }

    public function getAllCommentsByProduct($paramas = null){
        $data = $this->getBody();

        $id_product = $data->id_product;
        
        $comments = $this->model->getAllComments($id_product);

        $this->view->response($comments);
        
    }
    public function getOneComment($params = null){
        $id = $params[':ID'];
        $comment = $this->model->getOneComment($id);

        if ($comment)
            $this->view->response($comment);
          //mandar a la vista para mostrar comentario

        else
            $this->view->response("comentario id =  $id not Found", 404);
        
    }

    public function removeComment($params = null){
        $id = $params[':ID'];
      
        $comment = $this->model->getOneComment($id);

        if ($comment){
            $this->model->deleteComment($id);
            $this->view->response("comment id =  $id remove");    
        }   
        else
            $this->view->response("comment id =  $id not Found", 404);
        
    }
}
