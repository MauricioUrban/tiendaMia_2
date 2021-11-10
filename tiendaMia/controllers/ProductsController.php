<?php

include_once('models/productsModel.php');
include_once('models/CategoryModel.php');
include_once('views/productsView.php');
include_once('helpers/loginHelper.php');

class ProductsController {

    private $productModel;
    private $categoryModel;
    private $view;
    private $loginHelper;

    public function __construct() {
        $this->productModel = new ProductsModel();
        $this->categoryModel = new CategoriesModel();
        $this->view = new ProductsView();
        $this->loginHelper = new LoginHelper();
    }

    public function showProducts() {
        $products = $this->productModel->getAllProducts();
        $this->view->showProducts($products);
    }

    public function showProduct($id) {
        $product = $this->productModel->getProduct($id);
        $this->view->showProduct($product);
    }

    public function completeFormAdmin() {
        $this->loginHelper->checkLoggedIn();
        $categories = $this->categoryModel->getAllCategories();
        $products = $this->productModel->getAllProducts();
        $this->view->showFormsAdmin(  $products, $categories);
    }
    
    function showProductsEditForm($id){
        $this->loginHelper->checkLoggedIn();
        $product = $this->productModel->getProduct($id);
        $categories = $this->categoryModel->getAllCategories();
        $this->view->completeEditProductForm($product, $categories);
    }    

    function upsertProduct($product){
        $id= $_REQUEST['id'];
        if($id){
            $this->editProduct($id);
        }else{
            $this->insertProduct($product);
            var_dump($product);
        }
    }

    function editProduct($id){
            $this->loginHelper->checkLoggedIn();
            $productId= $_REQUEST['id'];
            $productName = $_REQUEST['name'];
            $productPrice = $_REQUEST['price'];
            $productSize = $_REQUEST['size'];
            $category_id = $_REQUEST['category_id'];
            
            $this->productModel->updateProduct($productId , $productName,floatval($productPrice), $productSize, $category_id);
            header("Location: " . BASE_URL."/admin");
    }

    
    function insertProduct($product){
        $this->loginHelper->checkLoggedIn();
        $productName= $_REQUEST['name'];
        $productSize = $_REQUEST['size'];
        $productPrice = $_REQUEST['price'];
        $category_id = $_REQUEST['category_id'];

        $this->productModel->insertProduct($productName, $productSize, floatval($productPrice), $category_id);
        header("Location: " . BASE_URL."/admin"); 
    }

    function deleteProduct($id){
        $this->loginHelper->checkLoggedIn();
        $this->productModel->deleteProduct($id);
        header("Location: " . BASE_URL ."/admin");

    }

   
}