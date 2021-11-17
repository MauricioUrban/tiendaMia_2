<?php

require_once './libs/smarty-master/libs/Smarty.class.php';

class ProductsView {

    private $smarty;

    function __construct(){
        $this->smarty = new Smarty();
    }

    
    function showProducts($products){
        $this->smarty->assign('titleProducts','Tu tienda de moda online');
        $this->smarty->assign('products', $products);
        $this->smarty->display('../templates/products/productsList.tpl');
    }

    function showProduct($product){
        $this->smarty->assign('titleProduct','Hecho para ti');
        $this->smarty->assign('product', $product);
        $this->smarty->display('../templates/products/productDetail.tpl');
    }

    function showProductsByCategory($products){
        $this->smarty->assign('tituloProducts','Elegido para');
        $this->smarty->assign('products', $products);
        $this->smarty->display('../templates/productsList.tpl');
    }

    function showFormsAdmin( $products, $categories){
        $this->smarty->assign('titulo','Categorias');
        $this->smarty->assign('categories', $categories);  
        $this->smarty->assign('titleAdmin','Productos');
        $this->smarty->assign('products', $products);
        $this->smarty->assign('sizes',['XS','S','M','L','XL','XXL']);
        $this->smarty->display('../templates/admin.tpl');  
    }

   
    function completeEditProductForm($product, $categories){
        $this->smarty->assign('product', $product);
        $this->smarty->assign('categories',$categories);
        $this->smarty->assign('sizes',['XS','S','M','L','XL','XXL']);
        $this->smarty->display('../templates/products/productsForm.tpl');
    }

    function showError($msgError) {
        $this->smarty->assign('error', $msgError);
        $this->smarty->display('../templates/admin.tpl');
    }
}