<?php
require_once 'libs/Router.php';
require_once 'api/apiCommentController.php';

$router = new Router();

$router->addRoute('comments', 'POST', 'ApiCommentController', 'add');
$router->addRoute('comments', 'GET', 'ApiCommentController', 'getAll');
$router->addRoute('comments/:ID', 'GET', 'ApiCommentController', 'getOne');
$router->addRoute('comments/:ID', 'DELETE', 'ApiCommentController', 'remove');
                 
$resource = $_GET["resource"];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resource, $method);


