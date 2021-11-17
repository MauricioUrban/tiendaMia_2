<?php


require_once('controllers/categoryController.php');
require_once('controllers/productsController.php');
require_once('controllers/loginController.php');

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']));


if (!empty($_GET['action'])){
    $action = $_GET['action'];
}
else {
    $action = 'home';
}
$params = explode('/', $action);

$controllerCategory = new CategoryController();
$controllerProducts = new ProductsController();


switch ($params[0]) {
    case 'home':
        $controllerProducts->showProducts(); // Muestra los productos
        break; 
    case 'admin':
        $controllerProducts->completeFormAdmin(); // trae la pagina del administrador
        break;
    case 'login':
        $loginController = new LoginController();
        $loginController->showLogin(); // trae la pagina para loguearse 
        break;
    case 'verify': 
        $loginController = new LoginController();
        $loginController->login(); // verifica si esta logueado o no
        break;
    case 'logout': 
        $loginController = new LoginController();
        $loginController->logout(); // desloguear
        break;
    case 'registerForm': 
        $loginController = new LoginController();
        $loginController->registerForm(); // pagina para registrarse
        break;
    case 'register': 
        $loginController = new LoginController();
        $loginController->registerUser(); //??
        break;
    case 'category':
        $controllerCategory->showCategories(); // muestra categorias
        break;
    case 'postCategory':
        $controllerCategory->upsertCategories($params[1]); // Si va con ID Edita sino inserta categorias
        break;
    case'editCategory':
        $controllerCategory->showCategoriesEditForm($params[1]); // muestra formulario editar categorias
        break;
    case 'deleteCategory':
        $controllerCategory->deleteCategory($params[1]); // borra categorias
        break;
    case 'productsCategory':
        $controllerCategory->showItemsByCategory($params[1]); // muestra item por categoria
        break;
    case 'postProduct':
        $controllerProducts->upsertProduct($params[1]); // Si va con id edita sino inserta producto      
        break;  
    case 'productView':
        $controllerProducts->showProduct($params[1]);  // muestra producto
        break;
    case 'deleteProduct':
        $controllerProducts->deleteProduct($params[1]); // borra producto
        break;
    case 'editProductForm':
        $controllerProducts->showProductsEditForm($params[1]); // muestra formulario para editar producto
        break;
    default:
        echo '404 - Página no encontrada';
        break;
}