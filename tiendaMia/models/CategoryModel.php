<?php

class CategoriesModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tienda;charset=utf8', 'root', '');
    }

   
    function getAllCategories() {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ); 
        return $categories;
    }

    function findCategoryById($id){
        $query = $this->db->prepare('SELECT * FROM `categories` WHERE id =?');
        $query->execute([$id]);    
        $category = $query->fetchAll(PDO::FETCH_OBJ);
        return !empty($category) ? $category[0] : null;
    }

    function deleteCategory($id){
        $query = $this->db->prepare('DELETE FROM categories WHERE id =?');
        $query->execute([$id]);
    }

    function insertCategory($category){
        $query = $this->db->prepare('INSERT INTO categories(name) VALUES (?)');
        $query->execute([$category]);
        return $this->db->lastInsertId();
    }

    function updateCategory($id, $categoryName){
        $query = $this->db->prepare('UPDATE categories SET name = ? WHERE id = ?');
        $query->execute([$categoryName, $id]);
        return $id;
    }
     

}
    
    
    


