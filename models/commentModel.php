<?php

class CommentModel
{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_tienda; charset=utf8', 'root', '');
    }

    function getAll(){ // trae todos los comentarios de prueba
        $query = $this->db->prepare('SELECT * FROM comments');
        $query->execute();
        
        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    function insertComment($comment, $core, $id_product, $id_user){
        $query = $this->db->prepare('INSERT INTO `comments`(`comment`, `core`, `id_product`, `id_user`) VALUES (?,?,?,?)');
        $query->execute([$comment, $core, $id_product, $id_user]);
        return $this->db->lastInsertId();
    }

    function getOneComment($id){
        $query = $this->db->prepare('SELECT `comments`(`comment`, `core`, `id_product`, `id_user`) WHERE id = ?');
        $query->execute(array($id));
        $comment = $query->fetch(PDO::FETCH_OBJ);
        return $comment;
    }

    function getAllComments($id){
        $query = $this->db->prepare('SELECT * FROM `comments` WHERE `id_product` = ?');
        $query->execute(array($id));
        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    function deleteComment($id){
        $query = $this->db->prepare('DELETE  FROM  `comments`  WHERE id= ?');
        $query->execute([$id]);
    }
}
