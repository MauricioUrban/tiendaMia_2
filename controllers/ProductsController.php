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
        $products = $this->productModel->getAllProducts(); //llama todos los productos
        $this->view->showProducts($products); // manda a renderizar los productos
    }

    public function showProduct($id) {
        $product = $this->productModel->getProduct($id); // llama un producto con el id
        $this->view->showProduct($product); // manda ese producto a la vista
    }

    public function completeFormAdmin() {
        $this->loginHelper->checkLoggedIn();// chequea si tiene autorizacion
        $categories = $this->categoryModel->getAllCategories(); // llama a todas las categorias
        $products = $this->productModel->getAllProducts(); // llama a todos los productos
        $this->view->showFormsAdmin(  $products, $categories); //manda los productos y las categorias a la vista
    }
    
    function showProductsEditForm($id){ // trae el formulario para editar productos
        $this->loginHelper->checkLoggedIn(); // chequea si tiene autorizacion
        $product = $this->productModel->getProduct($id); //trae productos 
        $categories = $this->categoryModel->getAllCategories(); // trae categorias
        $this->view->completeEditProductForm($product, $categories); // manda a la vista los productos y la categoria
    }    

    function upsertProduct($product){
        $id= $_REQUEST['id'];
        if($id){
            $this->editProduct($id);  // si viene un ID edita los productos
        }else{
            $this->insertProduct($product); // sino viene ID inserta
            var_dump($product);
        }
    }

    function editProduct($id){ // edita los productos
            $this->loginHelper->checkLoggedIn();
            
            $productId= $_REQUEST['id'];
            $productName = $_REQUEST['name'];
            $productPrice = $_REQUEST['price'];
            $productSize = $_REQUEST['size'];
            $category_id = $_REQUEST['category_id'];
            
            $this->productModel->updateProduct($productId , $productName,floatval($productPrice), $productSize, $category_id); // manda los datos al modelo
            header("Location: " . BASE_URL."/admin");
    }

    
    function insertProduct($product){ // inserta productos
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