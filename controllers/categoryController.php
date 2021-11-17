<?php

include_once('models/CategoryModel.php');
include_once('models/productsModel.php');
include_once('views/categoryView.php');
include_once('helpers/loginHelper.php');

 class CategoryController {

    private $categoryModel;
    private $productModel;
    private $view;
    private $loginHelper;
    

    public function __construct() {
        $this->categoryModel = new CategoriesModel();
        $this->productModel = new ProductsModel();
        $this->view = new CategoriesView();
        $this->loginHelper = new LoginHelper();
    }

    function showCategories() {
        $categories = $this->categoryModel->getAllCategories();
        $this->view->showCategories($categories);
    }
    
    function showItemsByCategory($id){ 
        $category = $this->categoryModel->findCategoryById($id); // busca la categoria 
        $products = $this->productModel->getByCategory($id); // trae todos los productos de la categoria ID
        $this->view->showItemsCategory($products,$category);
    }


    function upsertCategories($category){ // si viene id edita categoria
        $id= $_REQUEST['id'];
        if($id){
            $this->editCategory($id);
        }else{                             // sino viene la crea
            $this->createCategory($category);
        }
    }

    function createCategory($category){
        $this->loginHelper->checkLoggedIn();
        $category = $_REQUEST['name'];
        if(!empty($category)){
            $this->categoryModel->insertCategory($category);
            header("Location: " . BASE_URL."/admin"); 
        }else {
            $this->view->showError("Faltan datos obligatorios"); 
        }   
    }
    
     function editCategory($id){
        $this->loginHelper->checkLoggedIn();
        $categoryName = $_REQUEST['name'];
        $this->categoryModel->updateCategory($id, $categoryName);
        header("Location: " . BASE_URL ."/admin");
    }

    function showCategoriesEditForm($id){ // muestra formulario editar categoria
        $this->loginHelper->checkLoggedIn();
        $category = $this->categoryModel->findCategoryById($id);
        $this->view->completeEditForm($category);
    }

    function deleteCategory($id){
        $this->loginHelper->checkLoggedIn();
        $this->categoryModel->deleteCategory($id);
        header("Location: " . BASE_URL ."/admin");
    }

}

